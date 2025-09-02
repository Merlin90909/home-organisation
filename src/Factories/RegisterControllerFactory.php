<?php

namespace App\Factories;

class RegisterControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new RegisterController($this->objectManagerService->get(HtmlRenderer::class));
    }
}