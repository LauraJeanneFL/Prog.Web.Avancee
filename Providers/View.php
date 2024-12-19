<?php
namespace App\Providers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {
    private static $twig = null;

    public static function render($template, $data=[]){
        if (self::$twig === null) {
            // Chargeur de fichiers Twig : chemin absolu vers le dossier Views
            $loader = new FilesystemLoader(dirname(__DIR__, 1) . '/Views');
            self::$twig = new Environment($loader, [
                'debug' => true,
                'cache' => false, 
            ]);

            // Définit des variables globales
            self::$twig->addGlobal('base', '/ProgWebAvancee/Evaluations/TP3/');
            self::$twig->addGlobal('asset', '/ProgWebAvancee/Evaluations/TP3/public/assets/');

            // Vérifie si l'utilisateur est un invité
            $guest = !isset($_SESSION['finger_print']) || $_SESSION['finger_print'] !== md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
            self::$twig->addGlobal('guest', $guest);
            self::$twig->addGlobal('session', $_SESSION ?? []);
        }
        
        // Rend le template une seule fois
        echo self::$twig->render("$template.php", $data);
    }
    static public function redirect($url){
        header('Location: ' . rtrim(BASE, '/') . '/' . ltrim($url, '/'));
        exit;
    }
}
