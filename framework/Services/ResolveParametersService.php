<?php

namespace Framework\Services;

use ReflectionClass;

class ResolveParametersService
{

    public function resolve(string $className): array
    {
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return [];
        }

        $parameters = $constructor->getParameters();

        $parameterNames = [];

        foreach ($parameters as $parameter) {
            $parameterNames[] = $parameter->getType()->getName();
        }

        return $parameterNames;
    }
}