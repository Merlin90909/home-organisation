<?php
session_start();
require_once __DIR__ . '/../src/Interfaces/ControllerInterface.php';

require_once __DIR__ . '/../src/Services/htmlRenderer.php';

require_once __DIR__ . '/../src/Controller/DashboardController.php';
require_once __DIR__ . '/../src/Controller/ErrorController.php';
require_once __DIR__ . '/../src/Controller/ImpressumController.php';
require_once __DIR__ . '/../src/Controller/LoginController.php';
require_once __DIR__ . '/../src/Controller/RegisterController.php';

