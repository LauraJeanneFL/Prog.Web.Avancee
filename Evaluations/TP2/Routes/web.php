<?php

use App\Routes\Route;

use App\Controllers\HomeController;
use App\Controllers\AuteurController;
use App\Controllers\GenreController;
use App\Controllers\EmpruntController;
use App\Controllers\LivreController;

// Routes pour les auteurs
Route::get('/auteurs', 'AuteurController@index');
Route::get('/auteurs/create', 'AuteurController@create');
Route::post('/auteurs/store', 'AuteurController@store');
Route::get('/auteurs/edit/{id}', 'AuteurController@edit');
Route::post('/auteurs/update/{id}', 'AuteurController@update');
Route::post('/auteurs/delete/{id}', 'AuteurController@delete');

// Routes pour les genres
Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::post('/genres/store', 'GenreController@store');
Route::get('/genres/edit/{id}', 'GenreController@edit');
Route::post('/genres/update/{id}', 'GenreController@update');
Route::post('/genres/delete/{id}', 'GenreController@delete');

// Routes pour les emprunts
Route::get('/emprunts', 'EmpruntController@index');
Route::get('/emprunts/create', 'EmpruntController@create');
Route::post('/emprunts/store', 'EmpruntController@store');
Route::get('/emprunts/edit/{id}', 'EmpruntController@edit');
Route::post('/emprunts/update/{id}', 'EmpruntController@update');
Route::post('/emprunts/delete/{id}', 'EmpruntController@delete');

// Routes pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres/create', 'LivreController@create');
Route::post('/livres/store', 'LivreController@store');
Route::get('/livres/edit/{id}', 'LivreController@edit');
Route::post('/livres/update/{id}', 'LivreController@update');
Route::post('/livres/delete/{id}', 'LivreController@delete');

// Route de test
Route::get('/test', function () {
    echo "La route fonctionne correctement !";
});

use App\Providers\View;

Route::get('/twig-test', function () {
    View::render('home', ['title' => 'Page de test', 'message' => 'Twig fonctionne bien !']);
});