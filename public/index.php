<?php

declare(strict_types=1);

use App\Validators\Listvalidator;
use App\Validators\MinLengthValidator;
use App\Validators\NotEmptyValidator;
use App\Validators\PasswordSpecialCharValidator;
use App\Validators\ValidatorChain;
use Framework\Requests\httpRequests;
use Framework\Services\RouterService;
use Framework\Services\ObjectManagerService;
use Framework\Validators\PayloadValidator;

require __DIR__ . '/../boot/boot.php';

$factories = require __DIR__ . '/../config/factories.php';
$routes = require __DIR__ . '/../config/routes.php';

$objectManager = new ObjectManagerService($factories);
$router = new RouterService($objectManager, $routes);

$httpRequest = new httpRequests($_GET, $_POST, $_SERVER, $_SESSION);
$response = $router->route($httpRequest);
$response->send();
