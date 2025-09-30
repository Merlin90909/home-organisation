<?php

declare(strict_types=1);

use Framework\Requests\httpRequests;
use Framework\Services\ObjectManagerService;
use Framework\Services\RouterService;

require __DIR__ . '/../boot/boot.php';

$factories = require __DIR__ . '/../config/factories.php';
$routes = require __DIR__ . '/../config/routes.php';

date_default_timezone_set('Europe/Berlin');

$objectManager = new ObjectManagerService($factories);
$router = new RouterService($objectManager, $routes);

$httpRequest = new httpRequests($_GET, $_POST, $_SERVER, $_SESSION);
$response = $router->route($httpRequest);
$response->send();
