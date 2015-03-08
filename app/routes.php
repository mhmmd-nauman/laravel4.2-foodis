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

Route::post('/produto/add','ProdutoController@add');
Route::get('/produto/{tipo_produto}','ProdutoController@get');


/* Rotas dos Funcionarios */
Route::post('/funcionario/add', 'FuncionarioController@add');
Route::get('/funcionario/get', 'FuncionarioController@get');


/* Rotas dos Restaurantes */
Route::post('/restaurante/add','RestauranteController@addRestaurante');
Route::get('/restaurante/categoria/add/{categoria}','RestauranteController@addCategoria');
Route::get('/restaurante/open/{cidade}', 'RestauranteController@getOpen'); //Consulto os Restaurantes abertos em uma detminada cidade
Route::get('/restaurante/menu/{id_restaurante}', 'RestauranteController@getMenu'); //Consulto o cardapio de uma especifica cidade.
Route::get('/pedido/sendPedido', 'RestauranteController@sendPedido');
Route::get('/restaurante/calculo-pizza/{id_restaurante}','RestauranteController@getCalculoPizzaria');

/* Rotas das Taxas */
Route::get('/taxas/add/{valor_taxa}','TaxasController@setTaxa');

/* Rota das Cidades*/

Route::post('/cidade/add','CidadeController@add');