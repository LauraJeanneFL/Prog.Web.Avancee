<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\City;
use App\Providers\View;

class ClientController {
    
    public function index(){
       $client = new Client;

       $clients = $client->select('name');
       if($clients){
            //include('views/client/index_old.php');

            return View::render('client/index', ['clients'=>$clients]);
       }else{
        echo "error";
       }
    }

    public function show($data =[]){
        if(isset($data['id']) && $data['id']!=null){
            $client = new Client;
            $selectId = $client->selectId($data['id']);
            if($selectId){
                return View::render('client/show', ['client'=> $selectId]);
            } else {
                return View::render('error', ['msg'=>'Could not find this client']);
            }
        }
        return View::render('error');
    }

    public function create(){
        $city = new City;
        $cities = $city->select('city');

        return View::render('client/create', ['cities'=>$cities]);
    }

    public function store($data){
       $client = new Client;
       $insert = $client->insert($data); 

       if($insert){
            return View::redirect('clients');
       }else{
            return View::render('error');
       }

    //    $city = new City;
    //    $insertC = $city->insert($data);

    }
}

?>