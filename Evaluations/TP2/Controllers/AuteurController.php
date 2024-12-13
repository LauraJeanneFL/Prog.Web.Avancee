<?php

namespace App\Controllers;

use App\Database\Connexion;
use App\Models\Auteur;
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
        $this->twig = new Environment($loader, [
            'cache' => false,
        ]);
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
            $prenom = $_POST['prenom'] ?? null;
            $nom = $_POST['nom'] ?? null;

            if (!$prenom || !$nom) {
                throw new \Exception("Tous les champs sont requis.");
            }

            $this->auteurModel->ajouterAuteur($prenom, $nom);
            header('Location: ' . BASE . 'auteurs');
            exit;
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

 public function edit($id) {
    try {
        $auteur = $this->auteurModel->getById($id);
        echo $this->twig->render('auteurs/edit.html', ['auteur' => $auteur]);
    } catch (\Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
    public function update($id) {
        try {
            $prenom = $_POST['prenom'] ?? null;
            $nom = $_POST['nom'] ?? null;

            if (!$prenom || !$nom) {
                throw new \Exception("Tous les champs sont requis.");
            }

            $this->auteurModel->modifierAuteur($id, ['prenom' => $prenom, 'nom' => $nom]);
            header('Location: ' . BASE . 'auteurs');
            exit;
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}