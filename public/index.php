<?php

declare(strict_types=1);

require __DIR__ . '/../boot/boot.php';

$routes = require_once('../config/routes.php');

if ($path = $_SERVER['PATH_INFO'] ?? '/') {
    $controllerName = $routes[$path] ?? 'ErrorController';

    $objectManagerService = new ObjectManagerService();

    $controller = $objectManagerService->get($controllerName);

    /** @var ControllerInterface $controller */
    $html = $controller->handle($_POST, $_GET, $_SERVER, $_SESSION);
    echo $html;
}

