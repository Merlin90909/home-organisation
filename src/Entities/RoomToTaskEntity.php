<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('room_to_task')]
class RoomToTaskEntity implements EntityInterface
{
    public function __construct(
        public ?int        $id,
        #[OrmColumn('room_id')]
        public ?RoomEntity $room,
        #[OrmColumn('task_id')]
        public ?TaskEntity $task
    )
    {
    }

    public
    static function getTable(): string
    {
        return 'room_to_task';
    }

    public
    function setId(int $id): void
    {
        $this->id = $id;
    }
}