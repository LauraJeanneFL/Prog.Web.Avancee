<?php

namespace App\Models;

use App\Models\CRUD;

class Genre extends CRUD {
    protected $table = 'genre';
    protected $primaryKey = 'id_genre';
    protected $fillable = ['nom_genre'];
}