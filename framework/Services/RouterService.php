<?php

namespace Framework\Services;

use App\Controller\ErrorController;
use Framework\Interfaces\ControllerInterface;

class RouterService
{
    private ObjectManagerService $objectManager;

    private array $routes;

    public function __construct(ObjectManagerService $objectManager, array $routes)
    {
        $this->objectManager = $objectManager;
        $this->routes = $routes;
    }


    public function route(array $post, array $get, array $server, array $session)
    {
        $path = $server['PATH_INFO'] ?? '/';
        //sucht passenden Controller
        $controllerName = $this->routes[$path] ?? ErrorController::class;

        //erstellt Controller mit Dependencies
        /** @var ControllerInterface $controller */
        $controller = $this->objectManager->get($controllerName);

        //handle verarbeitet Request und gibt Responseobjekt zurück
        return $controller->handle($post, $get, $server, $session);
    }
}