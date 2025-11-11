<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('user_to_room')]
class UserToRoomEntity implements EntityInterface
{
    public function __construct(
        public ?int $id = null,
        #[OrmColumn('owner_id')]
        public ?UserEntity $ownerId = null,
        #[OrmColumn('room_id')]
        public ?int $roomId = null
    )
    {
    }

    public static function getTable(): string
    {
        return 'user_to_room';
    }
}