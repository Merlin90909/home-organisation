<?php

namespace App\Factories;

class WarehouseControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new WarehouseController(
            $this->objectManagerService->get(WarehouseService::class),
            $this->objectManagerService->get(HtmlRenderer::class),
        );
    }
}