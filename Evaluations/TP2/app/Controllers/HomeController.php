<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController {
    private $twig;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        echo $this->twig->render('home.php', [
            'title' => 'Page d\'Accueil',
            'message' => 'Bienvenue sur notre site web!'
        ]);
    }
}