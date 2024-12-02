<?php

include("models/ExemplemModel.php");

class ExempleModel {
    public function getData(){
        return "Hello from ExempleModel";
        include('views/gome.php');
    }

     public function about(){
        return "page a propos de nous";
    }
}