<?php

namespace App\Factories;

class LogoutServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LogoutService();
    }
}