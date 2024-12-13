<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Providers\Validator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class GenreController {
    private $genreModel;
    private $twig;

    public function __construct() {
        // Initialisation de PDO et Twig
        $pdo = (new \App\Database\Connexion())->getPdo();
        $this->genreModel = new Genre($pdo);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        try {
            $genres = $this->genreModel->getGenres();
            echo $this->twig->render('genres/index.html', ['genres' => $genres]);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function create() {
        echo $this->twig->render('genres/create.html');
    }

    public function store() {
        try {
            // Validation du formulaire
            $data = Validator::validateForm($_POST, ['nom_genre']);
            $this->genreModel->ajouterGenre($data['nom_genre']);
            header('Location: ' . BASE . 'auteurs');
            exit;
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function edit($id) {
        try {
            $genre = $this->genreModel->getById($id);
            echo $this->twig->render('genres/edit.html', ['genre' => $genre]);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}