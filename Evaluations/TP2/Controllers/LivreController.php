<?php

namespace App\Controllers;

use App\Models\Livre;
use App\Providers\Validator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class LivreController {
    private $livreModel;
    private $twig;

    public function __construct() {
        $pdo = (new \App\Database\Connexion())->getPdo();
        $this->livreModel = new Livre($pdo);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        try {
            $livres = $this->livreModel->getAll();
            echo $this->twig->render('livres/index.html', ['livres' => $livres]);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function create() {
        try {
            echo $this->twig->render('livres/create.html', ['title' => 'Ajouter un livre']);
        } catch (\Exception $e) {
            echo "Erreur lors du chargement de la vue : " . $e->getMessage();
        }
    }

    public function store() {
        try {
            // Validation des données
            $data = Validator::validateForm($_POST, [
                'titre',
                'annee_publication',
                'id_auteur',
                'id_genre',
                'quantite_disponible'
            ]);
            
            // Création du livre
            $this->livreModel->create($data);
            header('Location: ' . BASE . 'auteurs');
            exit;// Redirection après succès
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function edit($id) {
          try {
        $livre = $this->livreModel->getById($id); // Récupérer le livre par son ID
        echo $this->twig->render('livres/edit.html', ['livre' => $livre]);
    } catch (\Exception $e) {
        echo "Erreur lors du chargement de la page d'édition : " . $e->getMessage();
    }
    }

    public function update($id) {
        try {
            // Validation des données
            $data = Validator::validateForm($_POST, [
                'titre',
                'annee_publication',
                'id_auteur',
                'id_genre',
                'quantite_disponible'
            ]);

            // Mise à jour du livre
            $this->livreModel->update($id, $data);
            header('Location: /livres');
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $this->livreModel->delete($id);
            header('Location: /livres');
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}