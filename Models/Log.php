<?php

namespace App\Models;

use App\Models\CRUD;

class Log extends CRUD {
    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $fillable = ['id_utilisateur', 'ip', 'date', 'page'];

    public function record($page) {
        $this->insert([
            'id_utilisateur' => $_SESSION['user_id'] ?? null,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'date' => date('Y-m-d H:i:s'),
            'page' => $page
        ]);
    }
}