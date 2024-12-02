<?php
namespace App\Controllers;
use App\Models\View;
use App\Models\Auteur;


class AuteurController {
    public function index(){
        $auteur = new Auteur();

        $auteurs = $auteur->select('nom');
        if($auteurs){
            return View::render('auteur/index', ['auteurs'=>$auteurs]);
        } else{
            echo "Aucun auteur n'a été trouvé";
        }
    }

    public function show($data=[]){
        if(isset($data['id']) && $data['id']!=null){
            $auteur = new Auteur;
            $selectId = $auteur->selectId($data['id']);
            if($selectId){
                return View::render('auteur/show', ['auteur'=> $selectId]);
            } else {
                return View::render('error', ['msg'=>'Could not find this auteur']);
            }
        }
        return View::render('error');
    }

    public function create(){
        $auteur = new Auteur;
        $auteurs = $auteur->select('auteur');

        return View::render('auteur/create', ['auteurs'=>$auteurs]);
    }

    public function store($data){
        $auteur = new Auteur;
        $insert = $auteur->insert($data); 

        if($insert){
            return View::redirect('clients');
        } else {
            return View::render('error');
        }
    }

}