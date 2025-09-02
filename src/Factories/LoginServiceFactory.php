<?php

namespace App\Factories;

class LoginServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LoginService($this->objectManagerService->get(UserService::class));
    }
}