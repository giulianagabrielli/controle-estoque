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

Auth::routes(); // padrão o laravel coloca as rotas login e register

// rotas para Api Google
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle'); // como está dentro da pasta Auth, precisa dizer o caminho usando \. 
Route::get('/login/google/callback', 'Auth\LoginController@receiveDataGoogle'); // o google vai devolver os dados nessa rota

// rota home
Route::get('/home', 'HomeController@index')->name('home'); 

// crud produtos
Route::get('/produtos/cadastrar', 'ProductController@viewForm')->middleware('checkuser'); //criar um produto dentro do controller. Seria possível criar uma única função create, se a informação for por get, visualiza, e se for por post, cadastra. ->middleware para dizer que essa rota vai usar a  proteção  do middleware CheckUser
Route::post('/produtos/cadastrar', 'ProductController@create'); // rota que o usuário não vai ver porque são as informações do formulário enviadas por post
Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate')->middleware('checkuser'); // rotas parametrizadas atualizar/{id}, informações fixas e informações dinâmicas {}
Route::post('/produtos/atualizar', 'ProductController@update')->middleware('checkuser');
Route::get('/produtos', 'ProductController@viewAllProducts')->middleware('checkuser');
Route::get('/produtos/deletar/{id?}', 'ProductController@delete')->middleware('checkuser');



