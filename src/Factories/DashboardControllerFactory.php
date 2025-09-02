<?php

namespace App\Factories;

class DashboardControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new DashboardController(
            $this->objectManagerService->get(HtmlRenderer::class),
            $this->objectManagerService->get(DashboardService::class)
        );
    }
}