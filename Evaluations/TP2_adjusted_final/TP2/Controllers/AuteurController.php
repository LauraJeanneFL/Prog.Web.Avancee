<?php

namespace App\Controllers;

use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;

class AuteurController {
    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }
    
    public function index() {
        $auteur = new Auteur($this->pdo);
        $auteurs = $auteur->select();
        if ($auteurs) {
            return View::render('auteurs/index', ['auteurs' => $auteurs]);
        } else {
            return View::render('error', ['msg' => 'No authors found.']);
        }
    }

     public function show($data =[]){
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
        return View::render('auteurs/create');
    }

    public function store($data = []) {
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

    public function delete($data = []) {
        if (isset($data['id']) && $data['id'] != null) {
            $auteur = new Auteur($this->pdo);
            $delete = $auteur->delete($data['id']);
            if ($delete) {
                return View::redirect('auteurs');
            }
        }
        return View::render('error', ['msg' => 'Invalid author ID.']);
    }
}