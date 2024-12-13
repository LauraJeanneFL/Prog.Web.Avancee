<?php

namespace App\Models;

use App\Models\CRUD;

class Auteur extends CRUD {
    protected $table = 'auteur';
    protected $primaryKey = 'id_auteur';
    protected $fillable = ['prenom', 'nom'];
}