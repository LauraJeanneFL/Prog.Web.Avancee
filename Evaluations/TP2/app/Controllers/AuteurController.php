<?php

namespace App\Controllers;

use App\Database\Connexion;
use App\Models\Auteur;
use App\Providers\Validator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AuteurController {
    private $auteurModel;
    private $twig;

    public function __construct() {
        // Initialisation de PDO et Twig
        $pdo = (new Connexion())->getPdo();
        $this->auteurModel = new Auteur($pdo);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        try {
            $auteurs = $this->auteurModel->getAll();
            echo $this->twig->render('auteurs/index.html', ['auteurs' => $auteurs]);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function create() {
        echo $this->twig->render('auteurs/create.html');
    }

    public function store() {
        try {
            // Validation du formulaire
            $data = Validator::validateForm($_POST, ['prenom', 'nom']);
            $this->auteurModel->ajouterAuteur($data);

            // Redirection après ajout
            header('Location: /auteurs');
            exit();
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}