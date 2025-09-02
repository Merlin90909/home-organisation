<?php

namespace App\Factories;

class ReminderCreateServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new ReminderCreateService($this->objectManagerService->get(PDO::class));
    }
}