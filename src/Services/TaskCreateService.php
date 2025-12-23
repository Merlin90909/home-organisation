<?php

namespace App\Services;

use App\Entities\RoomEntity;
use App\Entities\RoomToTaskEntity;
use App\Entities\TaskEntity;
use App\Entities\UserEntity;
use App\Entities\UserToTaskEntity;
use Framework\Services\OrmService;
use PDO;

class TaskCreateService
{
    public function __construct(private OrmService $ormService)
    {
    }

    function create(
        int    $userId,
        int    $roomId,
        string $title,
        string $notes,
        string $due_at,
        string $priority,
        bool   $repeat,
        string $repeat_rule,
        string $created_at
    ): bool
    {
        $user = $this->ormService->findOneBy(
            [
                'id' => $userId
            ],
            UserEntity::class
        );

        $room = $this->ormService->findOneBy(
            [
                'room.id' => $roomId
            ],
            RoomEntity::class
        );

        $task = new TaskEntity(
            null,
            $title,
            $notes,
            $due_at,
            $priority,
            $repeat,
            $repeat_rule,
            $created_at,
            0,
            0,
            $user,
            $room
        );

        $this->ormService->save($task);

        $userTask = new UserToTaskEntity(null, $user, $task);
        $roomTask = new RoomToTaskEntity(null, $room, $task);

        $this->ormService->save($userTask);
        $this->ormService->save($roomTask);

        return true;
    }
}