<?php

namespace App\Controllers;

use App\Models\Livre;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class LivreController {
    private $livreModel;
    private $twig;

    public function __construct() {
        $pdo = new \PDO('mysql:host=localhost;dbname=librairie', 'root', '');
        $this->livreModel = new Livre($pdo);

        $loader = new FilesystemLoader('../app/Views');
        $this->twig = new Environment($loader);
    }

    public function index() {
        $livres = $this->livreModel->getAll();
        echo $this->twig->render('livres/index.html.twig', ['livres' => $livres]);
    }

    public function create() {
        echo $this->twig->render('livres/create.html.twig');
    }

    public function store() {
        $data = [
            'titre' => $_POST['titre'],
            'annee_publication' => $_POST['annee_publication'],
            'id_auteur' => $_POST['id_auteur'],
            'id_genre' => $_POST['id_genre'],
            'quantite_disponible' => $_POST['quantite_disponible'],
        ];
        $this->livreModel->create($data);
        header('Location: /public/index.php?route=livres');
    }

    public function delete($id) {
        $this->livreModel->delete($id);
        header('Location: /public/index.php?route=livres');
    }
}