<?php

use App\Controller\AccountController;
use App\Controller\AccountSubmitController;
use App\Controller\AllTasksController;
use App\Controller\ArchiveController;
use App\Controller\DashboardController;
use App\Controller\DashboardSubmitController;
use App\Controller\ErrorController;
use App\Controller\ImprintController;
use App\Controller\LoginController;
use App\Controller\LogInSubmitController;
use App\Controller\LogoutController;
use App\Controller\LogoutSubmitController;
use App\Controller\RegisterController;
use App\Controller\RegisterSubmitController;
use App\Controller\RoomController;
use App\Controller\RoomsController;
use App\Controller\RoomsSubmitController;
use App\Controller\TaskDeleteController;
use App\Controller\TaskSubmitController;
use App\Controller\TestController;
use App\Controller\WarehouseController;
use App\Controller\WarehouseSubmitController;

return [
    'GET' => [
        '/' => [
            'Controller' => DashboardController::class,
            'requestMethod' => 'GET',
        ],
        '/login' => [
            'Controller' => LoginController::class,
            'requestMethod' => 'GET',
            'public' => true,
        ],
        '/register' => [
            'Controller' => RegisterController::class,
            'requestMethod' => 'GET',
            'public' => true,
        ],
        '/logout' => [
            'Controller' => LogoutController::class,
            'requestMethod' => 'GET'
        ],
        '/impressum' => [
            'Controller' => ImprintController::class,
            'requestMethod' => 'GET',
            'public' => true,
        ],
        '/404' => [
            'Controller' => ErrorController::class,
            'requestMethod' => 'GET'
        ],
        '/rooms' => [
            'Controller' => RoomsController::class,
            'requestMethod' => 'GET'
        ],
        '/room/:id' => [
            'Controller' => RoomController::class,
            'requestMethod' => 'GET',
            'id' => 'int'
        ],
        '/warehouse' => [
            'Controller' => WarehouseController::class,
            'requestMethod' => 'GET'
        ],
        '/account' => [
            'Controller' => AccountController::class,
            'requestMethod' => 'GET'
        ],
        '/all-tasks' => [
            'Controller' => AllTasksController::class,
            'requestMethod' => 'GET'
        ],
        '/archive' => [
            'Controller' => ArchiveController::class,
            'requestMethod' => 'GET'
        ],
        //'test' =>[
        //    'Controller' =>TestController::class,
        //    'requestMethod' => 'GET'
        //]
    ],
    'POST' => [
        '/login-submit' => [
            'Controller' => LoginSubmitController::class,
            'requestMethod' => 'POST',
            'public' => true
        ],
        '/register-submit' => [
            'Controller' => RegisterSubmitController::class,
            'requestMethod' => 'POST',
            'public' => true
        ],
        '/logout-submit' => [
            'Controller' => LogoutSubmitController::class,
            'requestMethod' => 'POST'
        ],
        '/rooms-submit' => [
            'Controller' => RoomsSubmitController::class,
            'requestMethod' => 'POST'
        ],
        '/task-submit' => [
            'Controller' => TaskSubmitController::class,
            'requestMethod' => 'POST'
        ],
        '/task-delete' => [
            'Controller' => TaskDeleteController::class,
            'requestMethod' => 'POST'
        ],
        '/warehouse-submit' => [
            'Controller' => WarehouseSubmitController::class,
            'requestMethod' => 'POST'
        ],
        '/account-submit' => [
            'Controller' => AccountSubmitController::class,
            'requestMethod' => 'POST'
        ],
        '/dashboard-submit' => [
            'Controller' => DashboardSubmitController::class,
            'requestMethod' => 'POST'
        ]
    ]
];