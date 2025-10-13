<?php

namespace Framework\Services\QueryBuilder;

class DeleteQueryBuilder
{
    private string $tableName;
    private array $conditions = [];
    private array $params = [];


    public function from(string $tableName): self
    {
        $this->tableName = $tableName;
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
        $sql = sprintf('DELETE FROM %s', $this->tableName);

        if (!empty($this->conditions)) {
            $sql .= ' WHERE ' . implode(' OR ', $this->conditions);
        }

        return ['sql' => $sql . ';', 'params' => $this->params];
    }
}