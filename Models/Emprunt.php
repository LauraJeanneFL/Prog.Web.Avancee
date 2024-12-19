<?php

namespace App\Models;

use App\Models\CRUD;

class Emprunt extends CRUD {
    protected $table = 'emprunt';
    protected $primaryKey = 'id_emprunt';
    protected $fillable = ['id_livre', 'nom_emprunteur', 'date_emprunt', 'date_retour'];

     public function getAll() {
        return $this->select(); 
    }
}