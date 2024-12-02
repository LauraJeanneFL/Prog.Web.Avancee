<?php
namespace App\Controllers;
use App\Models\Client;
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
}

?>