<?php

namespace App\Entities;

use Framework\Interfaces\EntityInterface;

class UserEntity implements EntityInterface
{
    public function __construct(
        public int $id,
        public string $first_Name,
        public string $last_Name,
        public string $email,
        public string $password
    ) {
    }

    public static function getTable(): string
    {
        return 'user';
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

}