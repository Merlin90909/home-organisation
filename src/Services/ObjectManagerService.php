<?php

namespace App\Services;

class ObjectManagerService
{
    private array $objects = [];

    public function get(string $className)
    {
        if (!array_key_exists($className, $this->objects)) {
            $object = $this->build($className);
            $this->objects[$className] = $object;
        }

        return $this->objects[$className];
    }

    public function build(string $className)
    {
        $factoryName = $className . 'Factory';
        $factory = new $factoryName($this);

        if (!$factory instanceof FactoryInterface) {
            throw new RuntimeException('Missing Factoryinterface' . $factoryName);
        }

        return $factory->produce();
    }
}