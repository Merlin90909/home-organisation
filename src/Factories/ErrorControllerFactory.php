<?php
namespace App\Factories;

class ErrorControllerFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new ErrorController($this->objectManagerService->get(HtmlRenderer::class));
    }
}