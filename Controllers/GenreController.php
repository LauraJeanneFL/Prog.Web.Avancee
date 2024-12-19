<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Models\User;
use App\Models\Log;

use App\Providers\View;
use App\Providers\Validator;

class GenreController {
    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }

    public function index() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Genres');

        $genre = new Genre($this->pdo);
        $genres = $genre->getAll();
        if ($genres) {
            return View::render('genres/index', ['genres' => $genres]);
        } else {
            return View::render('error', ['msg' => 'No genres found.']);
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
        $this->logVisit('Genres');

        if(isset($data['id']) && $data['id']!=null){
            $genre = new Genre($this->pdo);
            $selectedGenre = $genre->selectId($data['id']);
            if($selectedGenre){
                return View::render('genres/show', ['genre'=> $selectedGenre]);
            } else {
                return View::render('error', ['msg'=>'Could not find this genre']);
            }
        }
        return View::render('error');
    }

    public function create() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');
        
        // Enregistrer la visite
        $this->logVisit('Genres');

        return View::render('genres/create');
    }

    public function store($data = []) {
        // Enregistrer la visite
        $this->logVisit('Genres');

        $validator = new Validator();
        $validator->field('nom_genre', $data['nom_genre'])->required()->min(2);

        if ($validator->isSuccess()) {
            $genre = new Genre($this->pdo);
            $insert = $genre->ajouterGenre($data['nom_genre']);
            if ($insert) {
                return View::redirect('genres');
            }
        }

        $errors = $validator->getErrors();
        return View::render('genres/create', ['errors' => $errors, 'inputs' => $data]);
    }

    public function edit($data = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');
            
        // Enregistrer la visite
        $this->logVisit('Genres');

        if (isset($data['id']) && $data['id'] != null) {
            $genre = new Genre($this->pdo);
            $selectedGenre = $genre->selectId($data['id']);
            if ($selectedGenre) {
                return View::render('genres/edit', ['genre' => $selectedGenre]);
            }
        }
        return View::render('error', ['msg' => 'Genre not found.']);
    }

    public function update($data = [], $get = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');
            
        // Enregistrer la visite
        $this->logVisit('Genres');

        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('nom_genre', $data['nom_genre'])->required()->min(2);

            if ($validator->isSuccess()) {
                $genre = new Genre($this->pdo);
                $update = $genre->modifierGenre($get['id'], $data);
                if ($update) {
                    return View::redirect('genres');
                }
            }

            $errors = $validator->getErrors();
            return View::render('genres/edit', ['errors' => $errors, 'inputs' => $data]);
        }
        return View::render('error', ['msg' => 'Invalid genre ID.']);
    }

    public function delete($id) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');
            
        // Enregistrer la visite
        $this->logVisit('Genres');

        // Vérifie et extrait l'ID si c'est un tableau
        if (is_array($id)) {
            $id = $id['id'];
        }

        // Assure-toi que l'ID est valide
        if ($id !== null && is_numeric($id)) {
            $modelClass = str_replace('Controller', '', (new \ReflectionClass($this))->getShortName());
            $modelClass = "App\\Models\\$modelClass";

            // Instancie dynamiquement le modèle (ex. Livre, Genre, etc.)
            $model = new $modelClass();
            
            // Tente la suppression
            if ($model->delete($id)) {
                return View::redirect(strtolower($modelClass) . 's'); // Redirige vers la liste
            }
        }
        return View::render('error', ['msg' => ucfirst(strtolower($modelClass)) . ' non trouvé ou suppression échouée.']);
    }
}