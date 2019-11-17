<?php

use App\Lib\Genero;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Paciente</h1>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Paciente</li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="row mb-3">
        <div class="col-md-12">

            @if (session('status'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('novo_paciente') }}" class="btn btn-primary">
                    <i class="far fa-file-alt"></i> &nbsp;
                        Cadastrar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Pesquisar') }}</div>
                <div class="card-body">

                    <form action="{{ route('pacientes') }}" method="GET">
                        <div class="form-group row">
                            <label for="filtro" class="col-md-3 col-form-label text-md-right">{{ __('Filtro') }}</label>

                            <div class="col-md-6">
                                <input id="filtro" type="text" class="form-control" name="filtro" value="{{ __($model->getFiltro()) }}">
                            </div>

                            <div class="3">
                                <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> &nbsp; Buscar</button>
                            </div>
                        </div>
                    </form>

                    @if( $model->getFiltro() != null && ($model->getFiltro() != "") )

                    <hr />

                    @if(count($model->getPacientesFiltro()) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nº Ficha</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Gênero</th>

                                <th scope="col"></th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($model->getPacientesFiltro() as $item)
                            <tr>
                                <td scope="row">{{ __($item->ficha_id) }}</td>
                                <td>{{ __($item->cpf) }}</td>
                                <td>{{ __($item->nome) }}</td>
                                <td>{{ __(Genero::getStringGenero($item->genero)) }}</td>

                                <td class="text-right">
                                    <a href="{{ route('exibir_paciente', [$item->id]) }}" class="btn btn-dark btn-sm"> <i class="far fa-folder-open"></i> &nbsp; Detalhes</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span>Nenhum resultado encontrado!</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Cadastros Recentes') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nº Ficha</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Gênero</th>

                                <th scope="col"></th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($model->getPacientesRecentes() as $item)
                            <tr>
                                <td scope="row">{{ __($item->ficha_id) }}</td>
                                <td>{{ __($item->cpf) }}</td>
                                <td>{{ __($item->nome) }}</td>
                                <td>{{ __(Genero::getStringGenero($item->genero)) }}</td>

                                <td class="text-right">
                                    <a href="{{ route('exibir_paciente', [$item->id]) }}" class="btn btn-dark btn-sm"><i class="far fa-folder-open"></i> &nbsp; Detalhes</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>


@endsection