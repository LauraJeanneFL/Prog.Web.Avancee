<?php
//Renforcer la sécurité des sessions
session_start([
    'cookie_lifetime' => 0, // Session cookie expire à la fermeture du navigateur
    'cookie_secure' => true, // Utilise uniquement HTTPS
    'cookie_httponly' => true, // Empêche JavaScript d'accéder aux cookies
    'use_strict_mode' => true, // Prévention des attaques par fixation de session
    'use_trans_sid' => false, // Pas de transmission des ID de session dans l'URL
]);

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'routes/web.php';
require_once 'Connexion.php';

?>