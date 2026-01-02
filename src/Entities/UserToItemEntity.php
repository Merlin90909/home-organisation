<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('item_to_user')]
class UserToItemEntity implements EntityInterface
{
    public function __construct(
        public ?int        $id,
        #[OrmColumn('user_id')]
        public ?UserEntity $userId,
        #[OrmColumn('item_id')]
        public ?ItemEntity $item_id
    )
    {
    }

    public static function getTable(): string
    {
        return 'item_to_user';
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}