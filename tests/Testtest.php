<?php

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class Testtest extends TestCase
{
    #[Test]
    public function demo(): void
    {
        self::assertTrue(true);
    }
}