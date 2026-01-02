<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('item_to_room')]
class RoomToItemEntity implements EntityInterface
{
    public function __construct(
        public ?int        $id,
        #[OrmColumn('room_id')]
        public ?RoomEntity $roomId,
        #[OrmColumn('item_id')]
        public ?ItemEntity $item_id
    )
    {
    }

    public static function getTable(): string
    {
        return 'item_to_room';
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}