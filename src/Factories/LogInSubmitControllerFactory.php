<?php

namespace App\Factories;

class LogInSubmitControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LogInSubmitController($this->objectManagerService->get(LoginService::class));
    }
}