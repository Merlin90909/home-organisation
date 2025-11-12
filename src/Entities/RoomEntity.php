<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmFk;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('room')]
class RoomEntity implements EntityInterface
{
    //setter Methode
        public ?int $id = null;
    public function __construct(
        public string $name,
        public string $description,
        #[OrmColumn('user_id')]
        public ?UserEntity $user = null,
        #[OrmColumn('created_at')]
        public string $created,
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public static function getTable(): string
    {
        return 'room';
    }
}