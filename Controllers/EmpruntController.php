<?php

namespace App\Controllers;
use App\Models\Log;
use App\Models\User;
use App\Models\Emprunt;

use App\Providers\View;
use App\Providers\Validator;

class EmpruntController {
      private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }

    public function index() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Emprunts');

        $emprunt = new Emprunt($this->pdo);
        $emprunts = $emprunt->getAll();
        if ($emprunts) {
            return View::render('emprunts/index', ['emprunts' => $emprunts]);
        } else {
            return View::render('error', ['msg' => 'No emprunts found.']);
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

    public function show($data = []) {
        // Enregistrer la visite
        $this->logVisit('Emprunts');

        if (isset($data['id']) && $data['id'] != null) {
               $emprunt = new Emprunt($this->pdo);
            $selectedEmprunt = $emprunt->selectId($data['id']);
            if ($selectedEmprunt) {
                return View::render('emprunts/show', ['emprunt' => $selectedEmprunt]);
            } else {
                return View::render('error', ['msg' => 'Could not find this emprunt']);
            }
        }
        return View::render('error');
    }

    public function create() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Emprunts');

        return View::render('emprunts/create');
    }

    public function store($data) {
        // Enregistrer la visite
        $this->logVisit('Emprunts');

        $validator = new Validator();
        $validator->field('id_livre', $data['id_livre'])->required()->number();
        $validator->field('nom_emprunteur', $data['nom_emprunteur'])->required()->min(2);
        $validator->field('date_emprunt', $data['date_emprunt'])->required();

        if ($validator->isSuccess()) {
               $emprunt = new Emprunt($this->pdo);
            $emprunt->insert([
                'id_livre' => $data['id_livre'],
                'nom_emprunteur' => $data['nom_emprunteur'],
                'date_emprunt' => $data['date_emprunt'],
                'date_retour' => $data['date_retour'] ?? null,
            ]);
            return View::redirect('/emprunts');
        } else {
            return View::render('emprunts/create', ['errors' => $validator->getErrors(), 'inputs' => $data]);
        }
    }

    public function edit($data = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Emprunts');

        if (isset($data['id']) && $data['id'] != null) {
            $emprunt = new Emprunt($this->pdo);
            $selectedEmprunt = $emprunt->selectId($data['id']);
            if ($selectedEmprunt) {
                return View::render('emprunts/edit', ['emprunt' => $selectedEmprunt]);
            } else {
                return View::render('error', ['msg' => 'Could not find this emprunt']);
            }
        }
        return View::render('error');
    }

    public function update($data = []) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Emprunts');

        $validator = new Validator();
        $validator->field('id', $data['id'])->required()->number();
        $validator->field('date_retour', $data['date_retour'])->required();

        if ($validator->isSuccess()) {
            $emprunt = new Emprunt($this->pdo);
            $emprunt->update(['date_retour' => $data['date_retour']], $data['id']);
            return View::redirect('/emprunts');
        } else {
            return View::render('emprunts/edit', ['errors' => $validator->getErrors(), 'inputs' => $data]);
        }
    }

    public function delete($id) {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin');

        // Enregistrer la visite
        $this->logVisit('Emprunts');

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