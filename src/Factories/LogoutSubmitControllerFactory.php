<?php

namespace App\Factories;

class LogoutSubmitControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LogoutSubmitController();
    }
}