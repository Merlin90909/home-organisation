<?php

namespace Framework\Services\QueryBuilder;

use Framework\Dtos\QueryDto;
use Exception;

final class InsertQueryBuilder extends AbstractQueryBuilder
{
    private array $columns = [];
    private array $placeholders = [];

    public function into(string $tableName): self
    {
        if ($tableName == '') {
            throw new Exception('No table used!');
        }
        $this->tableName = $tableName;
        return $this;
    }
    public function values(array $data): self {
        if ($data == []) {
            throw new Exception('No data!');}
        foreach ($data as $column => $value) {
            $placeholder = 'val_' . count($this->params);
            $this->columns[] = $column;
            $this->placeholders[] = ':' . $placeholder;
            $this->params[$placeholder] = $value;}
        return $this;}

    public function build(): QueryDto{
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s);',
            $this->tableName,
            implode(', ', $this->columns),
            implode(', ', $this->placeholders)
        );

        return new QueryDto($sql, $this->params);
    }
}