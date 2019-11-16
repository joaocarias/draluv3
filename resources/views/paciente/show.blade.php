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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pacientes') }}">Pacientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Exibir</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
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

        </div>
    </div>

    @if(isset($model->paciente) && ($model->paciente->id > 0) )

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Detalhes') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            Nome: <strong>{{ __($model->paciente->nome)  }}</strong>
                        </div>

                        <div class="col-md-2">
                            Nº Ficha: <strong>{{ __($model->paciente->ficha_id)  }}</strong>
                        </div>

                        <div class="col-md-4">
                            CPF: <strong>{{ __($model->paciente->cpf)  }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Gênero: <strong>{{ __(Genero::getStringGenero($model->paciente->genero))  }}</strong>
                        </div>

                        <div class="col-md-3">
                            Data de Nascimento: <strong>{{ __($model->paciente->data_de_nascimento)  }}</strong>
                        </div>

                        <div class="col-md-6">
                            E-Mail: <strong>{{ __($model->paciente->email)  }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Telefone: <strong>{{ __($model->paciente->telefone)  }}</strong>
                        </div>

                        <div class="col-md-9">
                            Observação: <strong>{{ __($model->paciente->observacao)  }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr /> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            Endereço: 
                                <strong> 
                                    {{ __($model->endereco->logradouro) }}
                                    {{ __(', ' . $model->endereco->numero) }}
                                    {{ __(', ' . $model->endereco->complemento) }}
                                    {{ __(' - ' . $model->endereco->bairro) }}
                                    {{ __(' - ' . $model->endereco->cidade) }}
                                    {{ __(' - ' . $model->endereco->uf) }}
                                </strong> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="row">
        <div class="col-md-12">           
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ __($model->mensagem) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>


@endsection