<?php

namespace App\Factories;

class ReminderDeleteFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new ReminderDeleteController(
            $this->objectManagerService->get(ReminderService::class),
            $this->objectManagerService->get(RoomsService::class),
            $this->objectManagerService->get(HtmlRenderer::class),
        );
    }
}