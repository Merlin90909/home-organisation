<?php

namespace App\Factories;

class RoomsControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RoomsController(
            $this->objectManagerService->get(RoomsService::class),
            $this->objectManagerService->get(HtmlRenderer::class),
        );
    }
}