<?php

namespace App\Services;

use App\Dtos\RoomDto;
use App\Entities\RoomEntity;
use Framework\Interfaces\EntityInterface;
use Framework\Services\OrmService;
use PDO;

class RoomsService
{
    public function __construct(private OrmService $ormService)
    {
    }

    public function getRooms(int $userId): array
    {
        $rooms = $this->ormService->findBy(
            [
                'user_id' => $userId
            ],
            RoomEntity::class
        );
        return $rooms;
    }

    private function createRoomDto(array $room): RoomDto
    {
        return new RoomDto(
            $room['users'],
            $room['name'],
            $room['description']
        );
    }

    public function getRoom(int $id): EntityInterface
    {
        $room = $this->ormService->findOneBy(
            [
                'room.id' => $id
            ],
            RoomEntity::class
        );

        return $room;
    }
}