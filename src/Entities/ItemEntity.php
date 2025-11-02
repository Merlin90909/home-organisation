<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('item')]
class ItemEntity implements EntityInterface
{
    public function __construct(
        public int $id,
        public string $name,
        public string $category,
        public int $amount,
        #[OrmColumn('user_id')]
        public int $user,
        #[OrmColumn('room_id')]
        public int $room

    )
    {
    }

    public static function getTable(): string
    {
        return 'item';
    }
}