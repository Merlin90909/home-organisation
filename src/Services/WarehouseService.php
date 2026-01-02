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
    public function __construct(private PDO $pdo, private OrmService $ormService)
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
        $stmt = $this->pdo->prepare(
            "SELECT i.name, i.category, i.amount, r.name AS room_name
           FROM item i
           LEFT JOIN room r ON r.id = i.room_id
          WHERE i.user_id = :id
       ORDER BY i.name COLLATE NOCASE, i.category COLLATE NOCASE"
        );
        $stmt->execute([':id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function getRoomNames($userId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT name, id
         FROM room
         WHERE user_id = :id;"
        );

        $stmt->execute([':id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

}