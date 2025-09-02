<?php

namespace App\Factories;

class UserServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new UserService($this->objectManagerService->get(PDO::class));
    }
}