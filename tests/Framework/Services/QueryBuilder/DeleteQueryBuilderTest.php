<?php

namespace Test\Framework\Services\QueryBuilder;

use Framework\Services\QueryBuilder\DeleteQueryBuilder;
use PHPUnit\Framework\TestCase;

class DeleteQueryBuilderTest extends TestCase
{
    public function testEmptyFrom(): void
    {
        $qb = new DeleteQueryBuilder();
        $result = $qb->from('')->where()->build();
    }
}