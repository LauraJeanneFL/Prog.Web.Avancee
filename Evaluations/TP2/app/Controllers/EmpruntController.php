<?php

namespace App\Controllers;

use App\Models\Emprunt;
use App\Providers\Validator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class EmpruntController {
    private $empruntModel;
    private $twig;

    public function __construct() {
        // Initialisation de PDO et Twig
        $pdo = (new \App\Database\Connexion())->getPdo();
        $this->empruntModel = new Emprunt($pdo);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        try {
            $emprunts = $this->empruntModel->getEmprunts();
            echo $this->twig->render('emprunts/index.html', ['emprunts' => $emprunts]);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function create() {
        echo $this->twig->render('emprunts/create.html');
    }

    public function store() {
        try {
            // Validation des données
            $data = Validator::validateForm($_POST, ['id_livre', 'nom_emprunteur', 'date_emprunt']);
            $this->empruntModel->ajouterEmprunt($data);

            // Redirection après ajout
            header('Location: /emprunts');
            exit();
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}