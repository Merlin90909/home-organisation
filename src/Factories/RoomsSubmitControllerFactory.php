<?php

namespace App\Factories;

class RoomsSubmitControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RoomsSubmitController(
            $this->objectManagerService->get(RoomsCreateService::class),
            $this->objectManagerService->get(HtmlRenderer::class),
            $this->objectManagerService->get(RoomsService::class),
        );
    }
}