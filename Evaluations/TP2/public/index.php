<?php

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de configuration
require_once __DIR__ . '/../config.php';

// Charger l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Charger les routes définies
require_once __DIR__ . '/../app/Routes/web.php';

// Test avec le routeur
\App\Routes\Route::get('/test', function () {
    echo "Route /test atteinte !";
});

// Lancer le routeur
\App\Routes\Route::dispatch();