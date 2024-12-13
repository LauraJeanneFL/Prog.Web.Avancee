<?php

namespace App\Controllers;

use App\Models\Livre;
use App\Providers\View;
use App\Providers\Validator;

class LivreController {

    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }
    public function index() {
        $livre = new Livre($this->pdo);
        $livres = $livre->getAll();
        if ($livres) {
            return View::render('livres/index', ['livres' => $livres]);
        } else {
            return View::render('error', ['msg' => 'No books found.']);
        }
    }

    public function show($data =[]){
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
        return View::render('livres/create');
    }

    public function store($data = []) {
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

    public function delete($data = []) {
        if (isset($data['id']) && $data['id'] != null) {
            $livre = new Livre($this->pdo);
            $delete = $livre->delete($data['id']);
            if ($delete) {
                return View::redirect('livres');
            }
        }
        return View::render('error', ['msg' => 'Invalid book ID.']);
    }
}