<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Providers\View;
use App\Providers\Validator;

class GenreController {
    private $pdo;

    public function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
    }

    public function index() {
       $genre = new Genre($this->pdo);
        $genres = $genre->getGenres();
        if ($genres) {
            return View::render('genres/index', ['genres' => $genres]);
        } else {
            return View::render('error', ['msg' => 'No genres found.']);
        }
    }

    public function show($data =[]){
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
        return View::render('genres/create');
    }

    public function store($data = []) {
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

    public function delete($data = []) {
        if (isset($data['id']) && $data['id'] != null) {
            $genre = new Genre($this->pdo);
            $delete = $genre->delete($data['id']);
            if ($delete) {
                return View::redirect('genres');
            }
        }
        return View::render('error', ['msg' => 'Invalid genre ID.']);
    }
}