<?php

namespace Framework\Services;

use App\Controller\ErrorController;
use Framework\Interfaces\ControllerInterface;

class RouterService
{
    private ObjectManagerService $objectManager;


    public function __construct(ObjectManagerService $objectManager, private array $routes)
    {
        $this->objectManager = $objectManager;
    }


    public function route(array $post, array $get, array $server, array $session)
    {
        $method = strtoupper($server['REQUEST_METHOD'] ?? 'GET');

        // Routen für die aktuelle Methode
        $methodRoutes = $this->routes[$method] ?? [];

        // Pfad gegen die Routen dieser Methode matchen und das passende Pattern zurückbekommen
        $path = $this->matchRoute($server['PATH_INFO'] ?? '/', array_keys($methodRoutes));

        // Versuche passenden Controller zu finden
        $controllerName = $methodRoutes[$path] ?? ErrorController::class;

        // erstellt Controller mit Dependencies
        /** @var ControllerInterface $controller */
        $controller = $this->objectManager->get($controllerName);

        // handle verarbeitet Request und gibt Responseobjekt zurück
        return $controller->handle($post, $get, $server, $session);
    }

    private function matchRoute($path, array $routes): ?string
    {
        $pathParts = explode('/', $path);

        foreach ($routes as $route) {
            $routeParts = explode('/', $route);
            $tempRoutes = $routeParts;
            $tempPath = $pathParts; // wichtig: pro Route neu setzen

            $i = 0;
            foreach ($tempRoutes as $part) {
                if (str_starts_with($part, ':')) {
                    unset($tempRoutes[$i]);
                    unset($tempPath[$i]);
                }
                $i++;
            }

            if ($tempRoutes === $tempPath) {
                // gib das Routen-Pattern (Key) zurück
                return $route;
            }
        }
        return null;
    }

}