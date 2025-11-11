<?php

namespace Framework\Services;

use App\Dtos\UserDto;
use App\Entities\UserEntity;
use Framework\Interfaces\EntityInterface;

class UserService
{

    public function __construct(private OrmService $ormService)
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
        $users = $this->ormService->findOneBy(
            [],
            UserEntity::class
        );
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