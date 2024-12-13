<?php

namespace App\Controllers;

use App\Providers\View;

class HomeController {

    public function index() {
        return View::render('home/index', [
            'title' => 'Page d\'Accueil',
            'message' => 'Bienvenue sur mon site web !'
        ]);
    }
}