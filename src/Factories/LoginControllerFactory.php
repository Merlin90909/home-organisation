<?php

namespace App\Factories;

class LoginControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new LoginController($this->objectManagerService->get(HtmlRenderer::class));
    }
}