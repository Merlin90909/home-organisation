<?php

session_start();

spl_autoload_register(function (string $class) {
    $directories = [
        __DIR__ . '/../src/Controller',
        __DIR__ . '/../src/Dtos',
        __DIR__ . '/../src/Interfaces',
        __DIR__ . '/../src/Services'
    ];
    foreach ($directories as $directory) {
        $filePath = $directory . '/' . $class . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
            return '';
        }
    }
});


//DD
function dd(mixed $var): void
{
    echo '<pre>';
    var_dump($var);
    exit;
}

