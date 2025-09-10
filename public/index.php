<?php

declare(strict_types=1);

use Framework\Services\RouterService;
use Framework\Services\ObjectManagerService;

require __DIR__ . '/../boot/boot.php';
require __DIR__ . '/../framework/Services/RouterService.php';
require __DIR__ . '/../framework/Services/ObjectManagerService.php';

$factories = require __DIR__ . '/../config/factories.php';
$routes    = require __DIR__ . '/../config/routes.php';

$objectManager = new ObjectManagerService($factories);
$router = new RouterService($objectManager, $routes);

//eigentliches Routing
$response = $router->route($_POST, $_GET, $_SERVER, $_SESSION);
//zurück an den Browser
$response->send();
