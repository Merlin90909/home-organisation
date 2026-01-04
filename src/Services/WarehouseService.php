<?php

namespace App\Services;

use App\Dtos\ItemDto;
use App\Entities\ItemEntity;
use App\Entities\RoomEntity;
use App\Entities\RoomToItemEntity;
use App\Entities\UserEntity;
use App\Entities\UserToItemEntity;
use App\Entities\UserToRoomEntity;
use Framework\Services\OrmService;
use PDO;

class WarehouseService
{
    public function __construct(private OrmService $ormService)
    {
    }

    public function edit(
        int    $userId,
        int    $roomId,
        string $name,
        string $category,
        int    $amount
    ): bool
    {

        $user = $this->ormService->findOneBy(
            [
                'user.id' => $userId
            ],
            UserEntity::class
        );
        $room = $this->ormService->findOneBy(
            [
                'room.id' => $roomId
            ],
            RoomEntity::class
        );

        $item = new ItemEntity(null, $name, $category, $amount, $user, $room);
        $this->ormService->save($item);

        $userItem = new UserToItemEntity(null, $user, $item);
        $this->ormService->save($userItem);

        $roomItem = new RoomToItemEntity(null, $room, $item);
        $this->ormService->save($roomItem);

        return true;
    }

    public function getItems($userId): array
    {
        $items = $this->ormService->findBY(
            [
                'user.id' => $userId
            ],
            ItemEntity::class
        );
        return $items;
    }

    public function getRoomNames($userId): array
    {
        $roomNames = $this->ormService->findBy(
            [
                'user.id' => $userId
            ],
            RoomEntity::class
        );
        return $roomNames;
    }

}