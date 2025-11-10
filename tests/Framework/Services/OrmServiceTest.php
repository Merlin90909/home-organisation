<?php

namespace Test\Framework\Services;

use PHPUnit\Framework\TestCase;

class OrmServiceTest extends TestCase
{
    public function createUser(): void
    {
        $pdo = $this->createMock(PDO::class);
    }
}