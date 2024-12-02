<?php
require_once('classes/CRUD.php');

$crud = new CRUD;
$update = $crud->update('client', $_POST);

if($update){
    header("location:client-index.php");
}else{
    echo 'error';
}




