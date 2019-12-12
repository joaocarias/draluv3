<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    /* Rotas para Usuário */
    Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('/usuarios/novo', 'UsuarioController@create')->name('novo_usuario');
    Route::post('/usuarios/store', 'UsuarioController@store')->name('cadastrar_usuario');
    Route::get('/usuarios/excluir/{id}', 'UsuarioController@destroy')->name('excluir_usuario');

    /* Rotas para Paciente */
    Route::get('/pacientes', 'PacienteController@index')->name('pacientes');
    Route::get('/pacientes/novo', 'PacienteController@create')->name('novo_paciente');
    Route::post('/pacientes/store', 'PacienteController@store')->name('cadastrar_paciente');
    Route::get('/pacientes/exibir/{id}', 'PacienteController@show')->name('exibir_paciente');
    Route::get('/pacientes/excluir/{id}', 'PacienteController@destroy')->name('excluir_paciente');
    Route::get('/pacientes/editar/{id}', 'PacienteController@edit')->name('editar_paciente');
    Route::put('/pacientes/update/{id}', 'PacienteController@update')->name('update_paciente');

    /* Rotas para Funcionario */
    Route::get('/funcionarios', 'FuncionarioController@index')->name('funcionarios');
    Route::get('/funcionarios/novo', 'FuncionarioController@create')->name('novo_funcionario');
    Route::get('/funcionarios/exibir/{id}', 'FuncionarioController@show')->name('exibir_funcionario');
    Route::post('/funcionarios/store', 'FuncionarioController@store')->name('cadastrar_funcionario');
    Route::get('/funcionarios/excluir/{id}', 'FuncionarioController@destroy')->name('excluir_funcionario');
    Route::get('/funcionarios/editar/{id}', 'FuncionarioController@edit')->name('editar_funcionario');
    Route::put('/funcionarios/update/{id}', 'FuncionarioController@update')->name('update_funcionario');

    /* Rotas para Produtos e Servicos */
    Route::get('/produtoseservicos', 'ProdutoServicoController@index')->name('produtoseservicos');
    Route::get('/produtoseservicos/novo', 'ProdutoServicoController@create')->name('novo_produto_servico');
    Route::post('/produtoseservicos/store', 'ProdutoServicoController@store')->name('cadastrar_produto_servico');
    Route::get('/produtoseservicos/editar/{id}', 'ProdutoServicoController@edit')->name('editar_produto_servico');    
    Route::put('/produtoseservicos/update/{id}', 'ProdutoServicoController@update')->name('update_produto_servico');
    Route::get('/produtoseservicos/excluir/{id}', 'ProdutoServicoController@destroy')->name('excluir_produto_servico');
    
    /* Rotas para Fornecedores */
    Route::get('/fornecedores', 'FornecedorController@index')->name('fornecedores'); 
    Route::get('/fornecedores/novo', 'FornecedorController@create')->name('novo_fornecedor');
    Route::post('/fornecedores/store', 'FornecedorController@store')->name('cadastrar_fornecedor');
    Route::get('/fornecedores/exibir/{id}', 'FornecedorController@show')->name('exibir_fornecedor');
    Route::get('/fornecedores/excluir/{id}', 'FornecedorController@destroy')->name('excluir_fornecedor');
    Route::get('/fornecedores/editar/{id}', 'FornecedorController@edit')->name('editar_fornecedor');
    Route::put('/fornecedores/update/{id}', 'FornecedorController@update')->name('update_fornecedor');
    Route::get('/fornecedores/excluir/{id}', 'FornecedorController@destroy')->name('excluir_fornecedores');
    
    Route::get('/funcoes', 'FuncaoController@index')->name('funcoes'); 
    Route::get('/funcoes/nova', 'FuncaoController@create')->name('nova_funcao');
    Route::post('/funcoes/store', 'FuncaoController@store')->name('cadastrar_funcao');
    Route::get('/funcoes/editar/{id}', 'FuncaoController@edit')->name('editar_funcao');    
    Route::put('/funcoes/update/{id}', 'FuncaoController@update')->name('update_funcao');
    Route::get('/funcoes/excluir/{id}', 'FuncaoController@destroy')->name('excluir_funcao');
    
    Route::get('/lotacoes/nova/{funcionario_id}', 'LotacaoController@create')->name('nova_lotacao');
    Route::post('/lotacoes/store', 'LotacaoController@store')->name('cadastrar_lotacao');
    
    // Route::resource('user', 'UserController', ['except' => ['show']]);
	// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	// Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});



