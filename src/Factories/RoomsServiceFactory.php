<?php

namespace App\Factories;

class RoomsServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RoomsService($this->objectManagerService->get(PDO::class));
    }
}