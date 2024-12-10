<?php

namespace App\Routes;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Views');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Désactivez le cache pour le développement
]);

class Route {
    private static $routes = [];

    public static function get($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    public static function post($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    // Ajoutez une méthode pour rendre les vues avec Twig
    public static function render($template, $data = []) {
        global $twig;

        if (!isset($twig)) {
            throw new \Exception("Twig n'est pas initialisé !");
        }

        try {
            echo $twig->render($template, $data);
        } catch (\Exception $e) {
            echo "Erreur lors du rendu du template $template : " . $e->getMessage();
        }
    }

   public static function dispatch(){
    $url = $_SERVER['REQUEST_URI'];
    $urlSegments = explode('?', $url);
    $urlPath = rtrim($urlSegments[0], '/');
    $method = $_SERVER['REQUEST_METHOD'];

    // Supprimer BASE de l'URL demandée
    if (strpos($urlPath, BASE) === 0) {
        $urlPath = substr($urlPath, strlen(BASE) - 1); // Corrige l'alignement
    }

    foreach(self::$routes as $route){
        if ($route['url'] === $urlPath && $route['method'] === $method) {
            // Vérifiez si le contrôleur est une Closure
            if (is_callable($route['controller'])) {
                // Appelez directement la Closure
                call_user_func($route['controller']);
                return;
            }

            // Gestion normale des contrôleurs
            $controllerSegments = explode('@', $route['controller']);
            $controllerName = "App\\Controllers\\" . $controllerSegments[0];
            $methodName = $controllerSegments[1];

            if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
                $controllerInstance = new $controllerName();

                if ($method === 'GET') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        return $controllerInstance->$methodName($queryParams);
                    } else {
                        return $controllerInstance->$methodName();
                    }
                } elseif ($method === 'POST') {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        return $controllerInstance->$methodName($_POST, $queryParams);
                    } else {
                        return $controllerInstance->$methodName($_POST);
                    }
                }
            } else {
                echo "Erreur : contrôleur ou méthode introuvable.";
                return;
            }
        }
    }

    http_response_code(404);
    echo "Erreur 404 : Route non définie pour $urlPath.";
}

   
}