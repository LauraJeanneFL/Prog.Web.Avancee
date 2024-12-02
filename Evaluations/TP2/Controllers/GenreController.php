<?php
namespace App\Controllers;
use App\Models\View;
use App\Models\Genre;


class GenreController {
    public function index(){
        $genre = new Genre();

        $genres = $genre->select('nom');
        if($genres){
            return View::render('genre/index', ['genres'=>$genres]);
        } else{
            echo "Aucun genre n'a été trouvé";
        }
    }

    public function show($data=[]){
        if(isset($data['id']) && $data['id']!=null){
            $Genre = new Genre;
            $selectId = $Genre->selectId($data['id']);
            if($selectId){
                return View::render('Genre/show', ['Genre'=> $selectId]);
            } else {
                return View::render('error', ['msg'=>'Could not find this Genre']);
            }
        }
        return View::render('error');
    }

    public function create(){
        $genre = new Genre;
        $genres = $genre->select('Genre');

        return View::render('Genre/create', ['genres'=>$genres]);
    }

    public function store($data){
        $genre = new Genre;
        $insert = $genre->insert($data); 

        if($insert){
            return View::redirect('clients');
        } else {
            return View::render('error');
        }
    }

}