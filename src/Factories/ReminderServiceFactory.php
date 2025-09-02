<?php
namespace App\Factories;

class ReminderServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new ReminderService($this->objectManagerService->get(PDO::class));
    }
}