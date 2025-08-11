<?php
declare(strict_types=1);

require __DIR__ . '/../boot/boot.php';

$route = $_SERVER['PATH_INFO'] ?? '/';

$routes = (require __DIR__ . '/../config/routes.php');
if(isset($routes[$route])) {
    require $routes[$route];
}else{
    require __DIR__ . '/../src/pages/404.php';
}