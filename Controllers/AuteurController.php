<?php

namespace App\Controllers;

use App\Models\Auteur;
use App\Models\User;
use App\Models\Log;

use App\Providers\View;
use App\Providers\Validator;

class AuteurController {
    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }
    
    public function index() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Auteurs');

        $auteur = new Auteur($this->pdo);
        $auteurs = $auteur->getAll();
        if ($auteurs) {
            return View::render('auteurs/index', ['auteurs' => $auteurs]);
        } else {
            return View::render('error', ['msg' => 'No authors found.']);
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
        // Enregistrer la visite
        $this->logVisit('Auteurs');

        if(isset($data['id']) && $data['id']!=null){
            $auteur = new Auteur($this->pdo);
            $selectedAuteur = $auteur->selectId($data['id']);
            if($selectedAuteur){
                return View::render('auteurs/show', ['auteur'=> $selectedAuteur]);
            } else {
                return View::render('error', ['msg'=>'Could not find this author']);
            }
        }
        return View::render('error');
     }

    public function create() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Auteurs');

        return View::render('auteurs/create');
    }

    public function store($data = []) {
        // Enregistre la visite
        $this->logVisit('Livres');

        $validator = new Validator();
        $validator->field('prenom', $data['prenom'])->required()->min(2);
        $validator->field('nom', $data['nom'])->required()->min(2);

        if ($validator->isSuccess()) {
            $auteur = new Auteur($this->pdo);
            $insert = $auteur->insert(['prenom' => $data['prenom'], 'nom' => $data['nom']]);
            if ($insert) {
                return View::redirect('auteurs');
            }
        }

        $errors = $validator->getErrors();
        return View::render('auteurs/create', ['errors' => $errors, 'inputs' => $data]);
    }

    public function edit($data = []) {
         // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Auteurs');

        $id = $_GET['id'] ?? null;
        if (isset($data['id']) && $data['id'] != null) {
            $auteur = new Auteur($this->pdo);
            $selectedAuteur = $auteur->selectId($data['id']);
            if ($selectedAuteur) {
                return View::render('auteurs/edit', ['auteur' => $selectedAuteur]);
            }
        }
        return View::render('error', ['msg' => 'Author not found.']);
    }

    public function update($data = [], $get = []) {
        // Vérifie si l'utilisateur a les droits admin
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistre la visite
        $this->logVisit('Livres');

        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('prenom', $data['prenom'])->required()->min(2);
            $validator->field('nom', $data['nom'])->required()->min(2);

            if ($validator->isSuccess()) {
                $auteur = new Auteur($this->pdo);
                $update = $auteur->update($data, $get['id']);
                if ($update) {
                    return View::redirect('auteurs');
                }
            }

            $errors = $validator->getErrors();
            return View::render('auteurs/edit', ['errors' => $errors, 'inputs' => $data]);
        }
        return View::render('error', ['msg' => 'Invalid author ID.']);
    }

    public function delete($id) {
        // Vérifie si l'utilisateur a les droits admin
        $user = new User();
        $user->redirectIfNoAccess('admin'); 

        // Enregistre la visite
        $this->logVisit('Livres');

        $auteur = new Auteur($this->pdo);
        if ($auteur->delete($id)) {
            return View::redirect('auteur');
        }
        return View::render('error', ['msg' => 'Suppression échouée.']);

        /* // Si $id est un tableau, récupère l'ID depuis le tableau
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
        return View::render('error', ['msg' => ucfirst(strtolower($modelClass)) . ' non trouvé ou suppression échouée.']); */
    }
}