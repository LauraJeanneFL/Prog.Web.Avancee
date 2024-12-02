<?php

require_once '../vendor/autoload.php';

require_once '../app/Controllers/LivreController.php';
require_once '../app/Controllers/AuteurController.php';
require_once '../app/Controllers/GenreController.php';

use App\Controllers\LivreController;
use App\Controllers\AuteurController;
use App\Controllers\GenreController;

// Récupérer la route
$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'home':
    echo "Bienvenue sur la bibliothèque";
    break;

    case 'livres':
        $controller = new LivreController();
        $controller->index();
        break;
    case 'livres/create':
        $controller = new LivreController();
        $controller->create();
        break;
    case 'livres/store':
        $controller = new LivreController();
        $controller->store();
        break;
    case 'livres/edit':
        $controller = new LivreController();
        $controller->edit($_GET['id']);
        break;
    case 'livres/update':
        $controller = new LivreController();
        $controller->update($_POST['id']);
        break;
    case 'livres/delete':
        $controller = new LivreController();
        $controller->delete($_GET['id']);
        break;
    case 'auteurs':
        $controller = new AuteurController();
        $controller->index();
        break;
    case 'genres':
        $controller = new GenreController();
        $controller->index();
        break;
    default:
        echo "Page d'accueil de la librairie.";
        break;
}