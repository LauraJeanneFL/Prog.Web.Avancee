<?php

use App\Routes\Route;

// Routes pour les auteurs
Route::get('/auteurs', 'AuteurController@index');
Route::get('/auteurs/create', 'AuteurController@create');
Route::get('/auteurs/edit', 'AuteurController@edit'); // Passer l'ID via les paramètres GET
Route::post('/auteurs/store', 'AuteurController@store');
Route::post('/auteurs/update', 'AuteurController@update'); // Passer l'ID via les données POST
Route::post('/auteurs/delete', 'AuteurController@delete'); // Passer l'ID via les données POST

// Routes pour les genres
Route::get('/genres', 'GenreController@index');
Route::get('/genres/create', 'GenreController@create');
Route::get('/genres/edit', 'GenreController@edit'); // Passer l'ID via les paramètres GET
Route::post('/genres/store', 'GenreController@store');
Route::post('/genres/update', 'GenreController@update'); // Passer l'ID via les données POST
Route::post('/genres/delete', 'GenreController@delete'); // Passer l'ID via les données POST

// Routes pour les emprunts
Route::get('/emprunts', 'EmpruntController@index');
Route::get('/emprunts/create', 'EmpruntController@create');
Route::get('/emprunts/edit', 'EmpruntController@edit'); // Passer l'ID via les paramètres GET
Route::post('/emprunts/store', 'EmpruntController@store');
Route::post('/emprunts/update', 'EmpruntController@update'); // Passer l'ID via les données POST
Route::post('/emprunts/delete', 'EmpruntController@delete'); // Passer l'ID via les données POST

// Routes pour les livres
Route::get('/livres', 'LivreController@index');
Route::get('/livres/create', 'LivreController@create');
Route::get('/livres/edit', 'LivreController@edit'); // Passer l'ID via les paramètres GET
Route::post('/livres/store', 'LivreController@store');
Route::post('/livres/update', 'LivreController@update'); // Passer l'ID via les données POST
Route::post('/livres/delete', 'LivreController@delete'); // Passer l'ID via les données POST

// Route de test
Route::get('/test', 'TestController@index');

// Twig-test (ajusté pour utiliser un contrôleur)
Route::get('/twig-test', 'HomeController@twigTest');

// Dispatch des routes
Route::dispatch();