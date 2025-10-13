<?php

namespace Framework\Services\QueryBuilder;

class UpdateQueryBuilder
{
    private ?string $tableName = null;
    private array $setValues = [];
    private array $conditions = [];
    private array $params = [];


    public function from(string $tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function set(array $values): self
    {
        foreach ($values as $column => $value) {
            $this->setValues[] = sprintf("%s = '%s'", $column, addslashes((string)$value));
        }
        return $this;
    }

    public function where(array $conditions): self
    {
        $groupParts = [];
        foreach ($conditions as $column => $value) {
            $placeholder = 'where_' . count($this->params);
            $groupParts[] = sprintf('%s = :%s', $column, $placeholder);
            $this->params[$placeholder] = $value;
        }
        $this->conditions[] = '(' . implode(' AND ', $groupParts) . ')';
        return $this;
    }

    public function build(): array
    {
        $sql = sprintf(
            'UPDATE %s SET %s',
            $this->tableName,
            implode(', ', $this->setValues)
        );

        if (!empty($this->conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->conditions);
        }

        return ['sql' => $sql . ';', 'params' => $this->params];
    }
}