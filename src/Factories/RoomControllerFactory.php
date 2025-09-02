<?php

namespace App\Factories;

class RoomControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RoomController(
            $this->objectManagerService->get(ReminderService::class),
            $this->objectManagerService->get(RoomsService::class),
            $this->objectManagerService->get(HtmlRenderer::class),
        );
    }
}