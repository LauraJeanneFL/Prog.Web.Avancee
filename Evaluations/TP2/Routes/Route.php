<?php

namespace App\Routes;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/../Views');
$twig = new Environment($loader, [
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

    public static function dispatch() {
    $url = $_SERVER['REQUEST_URI'];
    $urlSegments = explode('?', $url);
    $urlPath = rtrim($urlSegments[0], '/');
    $method = $_SERVER['REQUEST_METHOD'];

    foreach(self::$routes as $route){
        if(BASE.$route['url'] ==  $urlPath && $route['method'] == $method ){
            $controllerSegments = explode('@',$route['controller']);
            $controllerName = "App\\Controllers\\".$controllerSegments[0];
            $methodName = $controllerSegments[1];
            $constrollerInstance = new $controllerName();

            if($method=='GET'){
                if(isset($urlSegments[1])){
                    parse_str($urlSegments[1], $queryParams);
                    $constrollerInstance->$methodName($queryParams);
                }else {
                    $constrollerInstance->$methodName();
                }

            }elseif($method=='POST'){
                    if(isset($urlSegments[1])){
                        parse_str($urlSegments[1], $queryParams);
                        $constrollerInstance->$methodName($_POST, $queryParams);
                    }else {
                        $constrollerInstance->$methodName($_POST);
                    }
            }
                return;
            } 
        }
        http_response_code(404);
        echo "404 Not found";
    } 

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
}

/* 

foreach (self::$routes as $route) {
        // Convertir les paramètres dynamiques dans les routes
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route['url']);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';

        if (preg_match($pattern, $url, $matches) && $method === $route['method']) {
            array_shift($matches); // Retirer le match complet
            $controllerSegments = explode('@', $route['controller']);
            $controllerName = "App\\Controllers\\" . $controllerSegments[0];
            $methodName = $controllerSegments[1];

            if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
                $controllerInstance = new $controllerName();
                $controllerInstance->$methodName(...$matches);
                return;
            } else {
                http_response_code(500);
                echo "Erreur interne : Contrôleur ou méthode introuvable.";
                return;
            }
        }
    }

    // Route non trouvée
    http_response_code(404);
    echo "Erreur 404 : Route non définie pour $url.";
}
} */