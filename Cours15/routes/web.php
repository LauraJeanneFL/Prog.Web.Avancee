<?php
use App\Routes\Route;

use App\Controllers\HomeController;
use App\Controllers\ClientController;

Route::get('/home', 'HomeController@index');
Route::get('/about', 'HomeController@about');

Route::get('/clients', 'ClientController@index');
Route::get('/client/show', 'ClientController@show');
Route::get('/client/create', 'ClientController@create');
Route::post('/client/create', 'ClientController@store');
Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/delete', 'ClientController@delete');

Route::dispatch();

?>