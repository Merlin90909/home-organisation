<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

function is_type(mixed $value, string $type): bool
{
    return match ($type) {
        'int', 'integer' => is_numeric($value),
        'string' => is_string($value),
        default => false,
    };
}

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();