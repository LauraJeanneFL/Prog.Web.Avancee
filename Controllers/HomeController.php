<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;

class HomeController {

    public function index() {
        $user = new User();
        $user->redirectIfNoAccess('admin'); 

        return View::render('home/index', [
            'title' => 'Page d\'Accueil',
            'message' => 'Bienvenue sur mon site web !'
        ]);
    }
}