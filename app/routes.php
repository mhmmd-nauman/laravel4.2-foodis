<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login');
});

Route::get('/login', function(){
   return View::make('login');
});

Route::post('/add/restaurante', function(){
    $data = Input::all();
    echo json_encode($data);
});

Route::post('/add/horario', function(){
    $data = Input::all();
    echo json_encode($data);
});

Route::post('/add/funcionario', function(){
    $data = Input::all();
    echo json_encode($data);
});

Route::post('/logar','AutenticacaoController@logar');
Route::get('/dashboard','HomeController@dashboard');