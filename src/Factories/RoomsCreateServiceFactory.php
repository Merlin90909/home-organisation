<?php

namespace App\Factories;

class RoomsCreateServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RoomsCreateService($this->objectManagerService->get(PDO::class));
    }
}