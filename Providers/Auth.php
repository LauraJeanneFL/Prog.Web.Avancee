<?php

namespace App\Providers;

class Auth {
    public static function session() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function privilege($requiredRole) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] < $requiredRole) {
            header('HTTP/1.1 403 Forbidden');
            echo "Accès refusé.";
            exit;
        }
    }
}