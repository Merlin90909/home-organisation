<?php

namespace App\Entities;

use Framework\Interfaces\EntityInterface;

class UserEntity implements EntityInterface
{
    public function __construct(
        public int $user_id = 0,
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
    ) {
    }

    public static function getTable(): string
    {
        return 'user';
    }

    public function getId(): int
    {
        return $this->user_id;
    }

    public function setId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

}