<?php

namespace App\Factories;

class RegisterServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RegisterService($this->objectManagerService->get(PDO::class));
    }
}