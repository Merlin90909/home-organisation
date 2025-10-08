<?php

namespace Framework\Services;

use App\Entities\UserEntity;
use Framework\Interfaces\EntityInterface;
use PDO;

class OrmService
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @param class-string<EntityInterface> $entityClass
     */
    function findById(int $id, string $entityClass): ?object
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $entityClass::getTable() . ' WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new $entityClass(...$row);
    }

    /**
     * @param class-string<EntityInterface> $entityClass
     */
    function findAll(string $entityClass): array
    {
        $table = $entityClass::getTable();
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $table);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $entities = [];
        foreach ($rows as $row) {
            $entities[] = new $entityClass(...$row);
        }
        return $entities;
    }

    /**
     * @param class-string<EntityInterface> $entityClass
     */
    function findBy(array $filter, string $entityClass): array
    {
        $table = $entityClass::getTable();
        $where = [];
        $params = [];

        foreach ($filter as $col => $val) {
            $key = $col;
            $where[] = $col . ' = :' . $key;
            $params[$key] = $val;
        }
        $sql = 'SELECT * FROM ' . $table;
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $entities = [];
        foreach ($rows as $row) {
            $entities[] = new $entityClass(...$row);
        }
        return $entities;
    }

    /**
     * @param class-string<EntityInterface> $entityClass
     */
    function findOneBy(array $filter, string $entityClass): ?object
    {
        $table = $entityClass::getTable();
        $where = [];
        $params = [];

        foreach ($filter as $col => $val) {
            $key = $col;
            $where[] = $col . ' = :' . $key;
            $params[$key] = $val;
        }
        $sql = 'SELECT * FROM ' . $table;
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new $entityClass(...$row);
    }

    function delete(EntityInterface $entity): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $entity::getTable() . ' WHERE id = :id');
        $stmt->execute([
            'id' => $entity->getId()
        ]);
        unset($entity);
        return true;
    }

    public function save(EntityInterface $entity): bool
    {
        if ($entity->getId() == 0) {
            return $this->create($entity);
        }
        return $this->update($entity);
    }

    public function update(EntityInterface $entity): bool
    {
        // alle Daten; Ausgabe als Array
        $data = get_object_vars($entity);
        //id wird nicht geupdated (Counter)
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }
        // dynamisches Erstellen der Query
        $assignments = [];
        foreach (array_keys($data) as $col) {
            $assignments[] = $col . ' = :' . $col;
        }
        $sql = 'UPDATE ' . $entity::getTable() . ' SET ' . implode(', ', $assignments) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $params = $data;
        $params['id'] = $entity->getId();
        //Ausführung
        return $stmt->execute($params);
    }

    //von private auf public ändern, wenn save funktioniert
    public function create(EntityInterface $entity): bool
    {
        $data = get_object_vars($entity);
        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $entity::getTable(),
            implode(',', array_keys($data)),
            ':' . implode(',:', array_keys($data))
        );

        $stmt = $this->pdo->prepare($sql);
        $ok = $stmt->execute($data);
        if (!$ok) {
            return false;
        }

        if (method_exists($entity, 'setId')) {
            $entity->setId((int)$this->pdo->lastInsertId());
        }
        return true;
    }
}