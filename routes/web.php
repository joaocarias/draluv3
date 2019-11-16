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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('/usuarios/novo', 'UsuarioController@create')->name('novo_usuario');
    Route::post('/usuarios/store', 'UsuarioController@store')->name('cadastrar_usuario');
    Route::get('/usuarios/excluir/{id}', 'UsuarioController@destroy')->name('excluir_usuario');


    Route::get('/pacientes', 'PacienteController@index')->name('pacientes');
    Route::get('/pacientes/novo', 'PacienteController@create')->name('novo_paciente');
    Route::post('/pacientes/store', 'PacienteController@store')->name('cadastrar_paciente');

    // Route::resource('user', 'UserController', ['except' => ['show']]);
	// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	// Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});



