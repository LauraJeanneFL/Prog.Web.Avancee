<?php
namespace App\Controllers;
use App\Models\View;
use App\Models\emprunt;


class empruntController {
    public function index(){
        $emprunt = new emprunt();

        $emprunts = $emprunt->select('nom');
        if($emprunts){
            return View::render('emprunt/index', ['emprunts'=>$emprunts]);
        } else{
            echo "Aucun emprunt n'a été trouvé";
        }
    }

    public function show($data=[]){
        if(isset($data['id']) && $data['id']!=null){
            $emprunt = new emprunt;
            $selectId = $emprunt->selectId($data['id']);
            if($selectId){
                return View::render('emprunt/show', ['emprunt'=> $selectId]);
            } else {
                return View::render('error', ['msg'=>'Could not find this emprunt']);
            }
        }
        return View::render('error');
    }

    public function create(){
        $emprunt = new emprunt;
        $emprunts = $emprunt->select('emprunt');

        return View::render('emprunt/create', ['emprunts'=>$emprunts]);
    }

    public function store($data){
        $emprunt = new emprunt;
        $insert = $emprunt->insert($data); 

        if($insert){
            return View::redirect('clients');
        } else {
            return View::render('error');
        }
    }

}