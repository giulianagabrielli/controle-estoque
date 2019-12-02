<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // name é como um alias

Route::get('/produtos/cadastrar', 'ProductController@viewForm'); // criar um produto dentro do controller. Seria possível criar uma única função create, se a informação for por get, visualiza, e se for por post, cadastra.
Route::post('/produtos/cadastrar', 'ProductController@create'); // rota que o usuário não vai ver porque são as informações do formulário enviadas por post

Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate'); // rotas parametrizadas atualizar/{id}, informações fixas e informações dinâmicas {}
Route::post('/produtos/atualizar', 'ProductController@update');

Route::get('/produtos', 'ProductController@viewAllProducts');

Route::get('/produtos/deletar/{id?}', 'ProductController@delete');



