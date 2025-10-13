<?php

namespace Framework\Interfaces;

interface EntityInterface
{
public static function getTable(): string;
public function getId(): int;
//public function setId(int $id): void;
}
