<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Route;
use App\Models\User;
use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Controllers\AuteurController;
use App\Controllers\GenreController;
use App\Controllers\LivreController;
use App\Controllers\EmpruntController;
use App\Controllers\HomeController;

Route::get('/livres/delete/{id}', 'LivreController@delete');

Route::get('/admin', 'AdminController@dashboard');
Route::get('/users', 'UserController@index');
Route::post('/login', 'UserController@login');

// Route pour traiter le formulaire de connexion
Route::post('/login', [UserController::class, 'login']);

// Routes pour les auteurs
Route::get('/auteurs', 'AuteurController@index');
Route::get('/auteurs/create', 'AuteurController@create');
Route::get('/auteurs/edit/{id}', 'AuteurController@edit'); 
Route::post('/auteurs/store', 'AuteurController@store');
Route::post('/auteurs/update/{id}', 'AuteurController@update');
Route::post('/auteurs/delete/{id}', 'AuteurController@delete');

// Routes pour les genres
Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::get('/genres/edit/{id}', 'GenreController@edit'); 
Route::post('/genres/store', 'GenreController@store');
Route::post('/genres/update/{id}', 'GenreController@update'); 
Route::post('/genres/delete/{id}', 'GenreController@delete'); 

// Routes pour les emprunts
Route::get('/emprunts', 'EmpruntController@index');
Route::get('/emprunts/create', 'EmpruntController@create');
Route::get('/emprunts/edit/{id}', 'EmpruntController@edit'); 
Route::post('/emprunts/store', 'EmpruntController@store');
Route::post('/emprunts/update/{id}', 'EmpruntController@update');
Route::post('/emprunts/delete/{id}', 'EmpruntController@delete'); 

// Routes pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres/create', 'LivreController@create');
Route::get('/livres/edit/{id}', 'LivreController@edit'); 
Route::post('/livres/store', 'LivreController@store');
Route::post('/livres/update/{id}', 'LivreController@update'); 
Route::post('/livres/delete/{id}', 'LivreController@delete'); 

// Route pour les logs
Route::get('/logs', 'LogController@index');

// Route pour logout
Route::get('/logout', function () {
    (new User())->logout();
    header('Location: /login');
    exit;
});

// Route pour afficher le formulaire de connexion
Route::get('/login', function () {
    return App\Providers\View::render('login');
});


// Dispatch des routes
Route::dispatch(); 