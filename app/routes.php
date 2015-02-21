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

/* Rotas dos Produtos */

Route::post('/produto/pizza/add','ProdutoController@adicionarPizza'); //Adicionar Pizza
Route::post('/produto/esfiha/add','ProdutoController@adicionarEsfiha'); //Adicionar Esfiha
Route::post('/produto/salgado/add','ProdutoController@adicionarSalgado'); //Adicionar Salgado
Route::post('/produto/sanduiche/add','ProdutoController@adicionarSanduiche'); //Adicionar Sanduiche
Route::post('/produto/massas/add','ProdutoController@adicionarMassas'); //Adicionar Massas
Route::post('/produto/outros/add','ProdutoController@adicionarOutros'); //Adicionar Massas

Route::get('/produto/pizza/get', 'ProdutoController@buscarPizza');
Route::get('/produto/esfiha/get', 'ProdutoController@buscarEsfiha');
Route::get('/produto/salgado/get', 'ProdutoController@buscarSalgado');
Route::get('/produto/sanduiche/get', 'ProdutoController@buscarSanduiche');
Route::get('/produto/massas/get', 'ProdutoController@buscarMassas');
Route::get('/produto/outros/get', 'ProdutoController@buscarOutros');


/* Rotas dos Funcionarios */

Route::get('/funcionario/get', 'FuncionarioController@get');


/* Rotas dos Restaurantes */

Route::get('/restaurante/open/{cidade}', 'RestauranteController@getOpen');