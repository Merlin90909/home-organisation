<?php

namespace App\Services;

use App\Entities\RoomEntity;
use App\Entities\UserEntity;
use App\Entities\UserToRoomEntity;
use Framework\Services\OrmService;
use PDO;

class RoomsCreateService
{
    public function __construct(private OrmService $ormService)
    {
    }

    function create(int $userId, string $name, string $description)
    {
        if (empty($userId) || empty($name) || empty($description)) {
            return false;
        }

        $user = $this->ormService->findOneBy(
            [
                'id' => $userId
            ],
            UserEntity::class
        );

        $room = new RoomEntity(null, $name, $description, $user, date('Y-m-d H:i:s'));

        $this->ormService->save($room);

        $roomId = $room->id;
        dd($roomId);
        $userRoom = new UserToRoomEntity(null, $user, $roomId);

        $this->ormService->save($userRoom);
        return true;
    }
}