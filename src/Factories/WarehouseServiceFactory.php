<?php

namespace App\Factories;

class WarehouseServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new WarehouseService($this->objectManagerService->get(PDO::class));
    }
}