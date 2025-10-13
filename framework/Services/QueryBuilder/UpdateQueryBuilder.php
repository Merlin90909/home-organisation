<?php

namespace Framework\Services\QueryBuilder;

class UpdateQueryBuilder
{
    private ?string $tableName = null;
    private array $setValues = [];

    private array $conditions = [];

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
        foreach ($conditions as $key => $val) {
            $groupParts[] = sprintf("%s = '%s'", $key, addslashes((string)$val));
        }
        $this->conditions[] = '(' . implode(' AND ', $groupParts) . ')';
        return $this;
    }

    public function build(): string
    {
        $sql = sprintf(
            "UPDATE %s SET %s",
            $this->tableName,
            implode(', ', $this->setValues)
        );

        if (!empty($this->conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->conditions);
        }

        return $sql . ';';
    }
}