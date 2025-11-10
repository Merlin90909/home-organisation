<?php

namespace Framework\Services;

use App\Dtos\UserDto;
use App\Entities\UserEntity;
use Dom\Entity;
use Framework\Interfaces\EntityInterface;
use PDO;
use Framework\Services\OrmService;


class UserService
{

    public function __construct(private PDO $pdo, private OrmService $ormService)
    {
    }

    public function getUserByEmail(string $email): EntityInterface
    {
        $user = $this->ormService->findOneBy(
            [
                'email' => $email
            ],
            UserEntity::class
        );
        return $user;
    }

    private function getUsers(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM user');
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    private function createUserDto(array $user): UserDto
    {
        return new UserDto(
            $user['id'],
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['password'],
        );
    }

    public function getUserbyId(int $id): EntityInterface
    {
        $user = $this->ormService->findOneBy(
            [
                'id' => $id
            ],
            UserEntity::class
        );
        return $user;
    }

}