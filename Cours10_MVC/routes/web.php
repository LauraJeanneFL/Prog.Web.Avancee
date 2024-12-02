<?php
include('routes/Route.php');
include('controllers/HomeController.php');

Route::get('/home', 'HomeController@index');
Route::get('/about', 'HomeController@about');

?>
