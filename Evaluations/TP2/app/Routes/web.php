<?php 

use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\AuteurController;
use App\Controllers\EmpruntController;
use App\Controllers\LivreController;
use App\Controllers\GenreController;

// Route pour la page d'accueil
Route::get('/home', 'HomeController@index');

// Routes pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres/create', 'LivreController@create');
Route::post('/livres/store', 'LivreController@store');
Route::get('/livres/edit', 'LivreController@edit');
Route::post('/livres/update/{id}', 'LivreController@update');
Route::post('/livres/delete', 'LivreController@delete');

// Routes pour les auteurs
Route::get('/auteurs', 'AuteurController@index');
Route::get('/auteurs/create', 'AuteurController@create');
Route::post('/auteurs/store', 'AuteurController@store');
Route::get('/auteurs/edit', 'AuteurController@edit');
Route::post('/auteurs/delete', 'AuteurController@delete');

// Routes pour les genres
Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::post('/genres/store', 'GenreController@store');
Route::get('/genres/edit', 'GenreController@edit');
Route::post('/genres/delete', 'GenreController@delete');

// Routes pour les emprunts
Route::get('/emprunts', 'EmpruntController@index');
Route::get('/emprunts/create', 'EmpruntController@create');
Route::post('/emprunts/store', 'EmpruntController@store');
Route::get('/emprunts/edit', 'EmpruntController@edit');
Route::post('/emprunts/delete', 'EmpruntController@delete');

//tests
Route::get('/test', function () {
    echo "La route fonctionne correctement !";
});


// Lancer le routeur
Route::dispatch();
