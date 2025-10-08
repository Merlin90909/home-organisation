<?php

namespace App\Services;

use App\Entities\UserEntity;
use Framework\Services\OrmService;
use PDO;

class RegisterService
{
    public function __construct(private OrmService $ormService)
    {
    }

    function register(
        string $first_Name,
        string $last_Name,
        string $email,
        string $password,
        string $password2
    ): bool {
        if ($password !== $password2) {
            return false;
        }

        $user = new UserEntity(
            id: 0,
            first_Name: $first_Name,
            last_Name: $last_Name,
            email: $email,
            password: $password
        );
        return $this->ormService->save($user);
    }
}