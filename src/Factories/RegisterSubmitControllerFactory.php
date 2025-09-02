<?php

namespace App\Factories;

class RegisterSubmitControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RegisterSubmitController($this->objectManagerService->get(RegisterService::class));
    }
}