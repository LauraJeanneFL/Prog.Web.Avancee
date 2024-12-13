<?php

namespace App\Controllers;

use App\Models\Emprunt;
use App\Providers\View;
use App\Providers\Validator;

class EmpruntController {
      private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }

    public function index() {
        $emprunt = new Emprunt($this->pdo);
    
        $emprunts = $emprunt->select();
        if ($emprunts) {
            return View::render('emprunts/index', ['emprunts' => $emprunts]);
        } else {
            return View::render('error', ['msg' => 'No emprunts found.']);
        }
    }

    public function show($data = []) {
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
        return View::render('emprunts/create');
    }

    public function store($data) {
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

    public function delete($data = []) {
        if (isset($data['id']) && $data['id'] != null) {
            $emprunt = new Emprunt($this->pdo);
            $emprunt->delete($data['id']);
            return View::redirect('/emprunts');
        }
        return View::render('error', ['msg' => 'Invalid emprunt ID']);
    }
}