<?php

namespace App\Entities;

use Framework\Interfaces\EntityInterface;

class RoomEntity implements EntityInterface
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public UserEntity $user,
        public string $created_at,
    ) {
    }

    public static function getTable(): string
    {
        return 'room';
    }

    public function getId(): int
    {
        return $this->id;
    }
}