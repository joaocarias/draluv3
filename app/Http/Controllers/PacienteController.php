<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {
        return view('paciente.index');
    }

    public function create()
    {
        return view('paciente.create');
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->cep = $request->input('cep');
        $endereco->logradouro = $request->input('logradouro');
        $endereco->numero = $request->input('numero');
        $endereco->bairro = $request->input('bairro');
        $endereco->complemento = $request->input('complemento');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->usuario_cadastro = Auth::user()->id;
        $endereco->save();

        $paciente = new Paciente();
        $paciente->ficha_id = $request->input('ficha_id');
        $paciente->cpf = $request->input('cpf');
        $paciente->nome = $request->input('nome');
        $paciente->genero = $request->input('genero');
        $paciente->data_de_nascimento = $request->input('data_de_nascimento');
        $paciente->email = $request->input('email');
        $paciente->telefone = $request->input('telefone');
        $paciente->observacao = $request->input('observacao');
        $paciente->usuario_cadastro = Auth::user()->id;
        $paciente->endereco_id = $endereco->id;
        $paciente->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
