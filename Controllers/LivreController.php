<?php

namespace App\Controllers;

use App\Models\Livre;
use App\Models\User;
use App\Models\Log;

use App\Providers\View;
use App\Providers\Validator;

class LivreController {

    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }
    public function index() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Livres');

        $livre = new Livre($this->pdo);
        $livres = $livre->getAll();
        if ($livres) {
            return View::render('livres/index', ['livres' => $livres]);
        } else {
            return View::render('error', ['msg' => 'No books found.']);
        }
    }

    private function logVisit($page) {
        $log = new Log();
        $logData = [
            'id_utilisateur' => $_SESSION['user_id'] ?? null,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'date' => date('Y-m-d H:i:s'),
            'page' => $page
        ];
        $log->insert($logData);
    }

    public function show($data =[]){
        // Enregistre la visite
        $this->logVisit('Livres');

        if(isset($data['id']) && $data['id']!=null){
            $livre = new Livre($this->pdo);
            $selectedLivre = $livre->selectId($data['id']);
            if($selectedLivre){
                return View::render('livres/show', ['livre'=> $selectedLivre]);
            } else {
                return View::render('error', ['msg'=>'Could not find this book']);
            }
        }
        return View::render('error');
    }

    public function create() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistre la visite
        $this->logVisit('Livres');

        return View::render('livres/create');
    }

    public function store($data = []) {
        // Enregistre la visite
        $this->logVisit('Livres');

        $validator = new Validator();
        $validator->field('titre', $data['titre'])->required()->min(2);
        $validator->field('annee_publication', $data['annee_publication'])->required()->number();
        $validator->field('id_auteur', $data['id_auteur'], "Auteur")->required()->number();
        $validator->field('id_genre', $data['id_genre'], "Genre")->required()->number();
        $validator->field('quantite_disponible', $data['quantite_disponible'])->required()->number();

        if ($validator->isSuccess()) {
            $livre = new Livre($this->pdo);
            $insert = $livre->insert($data);
            if ($insert) {
                return View::redirect('livres');
            }
        }

        $errors = $validator->getErrors();
        return View::render('livres/create', ['errors' => $errors, 'inputs' => $data]);
    }

    public function edit($data = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistre la visite
        $this->logVisit('Livres');

        if (isset($data['id']) && $data['id'] != null) {
            $livre = new Livre($this->pdo);
            $selectedLivre = $livre->selectId($data['id']);
            if ($selectedLivre) {
                return View::render('livres/edit', ['livre' => $selectedLivre]);
            }
        }
        return View::render('error', ['msg' => 'Book not found.']);
    }

    public function update($data = [], $get = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistre la visite
        $this->logVisit('Livres');

        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('titre', $data['titre'])->required()->min(2);
            $validator->field('annee_publication', $data['annee_publication'])->required()->number();
            $validator->field('id_auteur', $data['id_auteur'], "Auteur")->required()->number();
            $validator->field('id_genre', $data['id_genre'], "Genre")->required()->number();
            $validator->field('quantite_disponible', $data['quantite_disponible'])->required()->number();

            if ($validator->isSuccess()) {
                $livre = new Livre($this->pdo);
                $update = $livre->update($get['id'], $data);
                if ($update) {
                    return View::redirect('livres');
                }
            }

            $errors = $validator->getErrors();
            return View::render('livres/edit', ['errors' => $errors, 'inputs' => $data]);
        }
        return View::render('error', ['msg' => 'Invalid book ID.']);
    }

    public function delete($id) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistre la visite
        $this->logVisit('Livres');
        
        // Si $id est un tableau, récupère l'ID depuis le tableau
        if (is_array($id)) {
            $id = $id['id'];
        }

        // Vérifie si $id est non null et numérique
        if ($id !== null && is_numeric($id)) {
            $modelClass = str_replace('Controller', '', (new \ReflectionClass($this))->getShortName());
            $modelClass = "App\\Models\\$modelClass";

            // Instancie dynamiquement le modèle 
            $model = new $modelClass();
            
            // Tente la suppression
            if ($model->delete($id)) {
                return View::redirect(strtolower($modelClass) . 's'); // Redirige vers la liste
            }
        }
        return View::render('error', ['msg' => ucfirst(strtolower($modelClass)) . ' non trouvé ou suppression échouée.']);
    }
}