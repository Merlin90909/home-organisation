<?php

namespace App\Factories;

class ImprintControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new ImprintController($this->objectManagerService->get(HtmlRenderer::class));
    }
}