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
    function findById(int $id, string $entityClass): object
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $entityClass::getTable() . ' WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
        $data = get_object_vars($entity);
        $set= explode(':', $data);


        //$data = get_object_vars($entity);
        //$set = implode(' = ?, ', array_keys($data)) . ' = ?';
        //$sql = 'UPDATE ' . $entity::getTable() . ' SET ' . $set . ' WHERE id = ?';
        //$stmt = $this->pdo->prepare($sql);
        //return $stmt->execute([...array_values($data), $entity->getId()]);
        return '';
    }

    private function create(EntityInterface $entity): bool
    {
        $data = get_object_vars($entity);
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $entity::getTable(),
            implode(',', array_keys($data)),
            ':' . implode(',:', array_keys($data))
        );

        $this->pdo->prepare($sql)->execute($data);
        $entity->setId($this->pdo->lastInsertId());
        return true;
    }
}