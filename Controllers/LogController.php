<?php
namespace App\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Providers\View;

class LogController {

    public function index() {
        // Vérifie l'accès
        $user = new User();
        $user->redirectIfNoAccess('admin'); 

        $log = new Log();
        $logs = $log->select();
        return View::render('logs/index', ['logs' => $logs]);
    }
}