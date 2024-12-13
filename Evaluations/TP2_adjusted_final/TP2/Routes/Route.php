<?php

namespace App\Routes;

class Route {
    private static $routes = [];

    // Ajouter une route GET
    public static function get($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    // Ajouter une route POST
    public static function post($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    // Dispatcher les requêtes vers le bon contrôleur et la bonne méthode
    public static function dispatch() {
        $url = $_SERVER['REQUEST_URI'];
        $urlSegments = explode('?', $url);
        $urlPath = rtrim($urlSegments[0], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if (BASE . $route['url'] == $urlPath && $route['method'] == $method) {
                $controllerSegments = explode('@', $route['controller']);
                $controllerName = "App\\Controllers\\" . $controllerSegments[0];
                $methodName = $controllerSegments[1];
                $controllerInstance = new $controllerName();

                if ($method == 'GET') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($queryParams);
                    } else {
                        $controllerInstance->$methodName();
                    }
                } elseif ($method == 'POST') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($_POST, $queryParams);
                    } else {
                        $controllerInstance->$methodName($_POST);
                    }
                }
                return;
            }
        }
        
        // Route non trouvée
        http_response_code(404);
        echo "404 Not found";
    }
}