<?php

use App\Controller\LogInSubmitController;
use App\Factories\LogInSubmitControllerFactory;
use App\Factories\PDOFactory;



return [
    LogInSubmitController::class => LogInSubmitControllerFactory::class,
    PDO::class => PDOFactory::class,

];