<?php

namespace App\Factories;

class HtmlRendererFactory implements FactoryInterface
{
    public function __construct(private ObjectManagerService $objectManagerService)
    {
    }

    public function produce(): object
    {
        return new HtmlRenderer();
    }
}