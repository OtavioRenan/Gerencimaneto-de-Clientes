<?php

Route::get('/', 'Auth\LoginController@login');
Auth::routes();


Route::group(['prefix' => '/', 'middleware' => ['permissao', 'auth']], function(){
    Route::get('/home', 'HomeController@index');
//--
    Route::get('/usuario', 'UsuariosController@index');
    Route::delete('/usuario/delete/{id}', 'UsuariosController@delete');
    Route::get('/usuario/edit/{id}', 'UsuariosController@edit');
    Route::post('/usuario/update/{id}', 'UsuariosController@update');
    Route::post('/usuario/create', 'UsuariosController@create');
//--
Route::get('/clientes', 'ClienteController@index');
Route::delete('/clientes/delete/{id}', 'ClienteController@delete');
Route::get('/clientes/edit/{id}', 'ClienteController@edit');
Route::post('/clientes/update/{id}', 'ClienteController@update');
Route::post('/clientes', 'ClienteController@create');
//--
}); 