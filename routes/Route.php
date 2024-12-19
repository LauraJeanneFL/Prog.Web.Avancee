<?php
namespace App;


class Route {
    private static $routes = [];

    public static function get($url, $controller){
        self::$routes[] = ['url' => $url, 'controller'=> $controller, 'method' => 'GET'];
    }

    public static function post($url, $controller){
        self::$routes[] = ['url' => $url, 'controller'=> $controller, 'method' => 'POST'];
    }

    public static function dispatch(){
        echo "Route fonctionne !";

        // Obtenir l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
        $urlSegments = explode('?', $url);
        $urlPath = rtrim($urlSegments[0], '/');

        // Retirer la base URL dynamiquement
        $base = '/ProgWebAvancee/Evaluations/TP3';
        $urlPath = str_replace($base, '', $urlPath);

        $method = $_SERVER['REQUEST_METHOD'];
       
        foreach(self::$routes as $route){
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route['url']);
            $pattern = "#^" . $pattern . "$#";

            // Vérifie si l'URL actuelle correspond au modèle
            if (preg_match($pattern, $urlPath, $matches) && $route['method'] === $method) {
                array_shift($matches); // Enlève le premier élément (l'URL complète)

                // Gestion des closures (fonctions anonymes)
                if (is_callable($route['controller'])) {
                    call_user_func_array($route['controller'], $matches);
                    return;
                }

                // Gestion des contrôleurs
                if (is_array($route['controller'])) {
                    $controllerName = $route['controller'][0];
                    $methodName = $route['controller'][1];
                } else {
                    $controllerSegments = explode('@', $route['controller']);
                    $controllerName = "App\\Controllers\\" . $controllerSegments[0];
                    $methodName = $controllerSegments[1];
                }
    
                $controllerInstance = new $controllerName();

                if ($method === 'GET') {
                    $controllerInstance->$methodName(...$matches);
                } elseif ($method === 'POST') {
                    $controllerInstance->$methodName($_POST, ...$matches);
                }
                return;
            } 
        }
        // Si aucune route ne correspond
        http_response_code(404);
        echo "404 Not found";
    } 
}
?>