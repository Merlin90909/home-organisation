<?php
namespace App\Factories;

class DashboardServiceFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new DashboardService($this->objectManagerService->get(ReminderService::class));
    }
}