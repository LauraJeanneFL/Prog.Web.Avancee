<?php

namespace App\Models;

use App\Models\CRUD;

class Livre extends CRUD {
    protected $table = 'livre';
    protected $primaryKey = 'id_livre';
    protected $fillable = [
        'titre',
        'annee_publication',
        'id_auteur',
        'id_genre',
        'quantite_disponible'
    ];

    public function getAll() {
        return $this->select(); 
    }
}