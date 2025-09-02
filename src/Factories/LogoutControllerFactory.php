<?php

namespace App\Factories;

class LogoutControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LogoutController($this->objectManagerService->get(HtmlRenderer::class));
    }
}