<?php

namespace Framework\Services\QueryBuilder;

use Framework\Dtos\QueryDto;

abstract class AbstractQueryBuilder
{
    protected ?string $tableName = null;
    protected array $params =[];
    protected array $conditions = [];

   abstract public function build(): QueryDto;

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
}