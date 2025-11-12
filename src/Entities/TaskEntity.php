<?php

namespace App\Entities;

use Framework\Attributes\OrmColumn;
use Framework\Attributes\OrmTable;
use Framework\Interfaces\EntityInterface;

#[OrmTable('task')]
class TaskEntity implements EntityInterface
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $notes,
        #[OrmColumn('due_at')]
        public string $due,
        public string $priority,
        public bool $repeat,
        #[OrmColumn('repeat_rule')]
        public string $repeatRule,
        #[OrmColumn('created_at')]
        public string $created,
        public bool $deleted,
        public bool $checked,
        //public int $created_by,
        #[OrmColumn('user_id')]
        public int $user,
        //public int $created_for,
        #[OrmColumn('room_id')]
        public int $room

    ) {
    }

    public static function getTable(): string
    {
        return 'task';
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}