<?php

use App\Lib\Genero;
use App\Lib\Auxiliar;

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Funcionário</h1>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('funcionarios') }}">Funcionários</a></li>
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

    @if(isset($model->funcionario) && ($model->funcionario->id > 0) )

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Detalhes') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            Nome: <strong>{{ __($model->funcionario->nome)  }}</strong>
                        </div>

                        <div class="col-md-6">
                            CPF: <strong>{{ __($model->funcionario->cpf)  }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Gênero: <strong>{{ __(Genero::getStringGenero($model->funcionario->genero))  }}</strong>
                        </div>

                        <div class="col-md-3">
                            Data de Nascimento: <strong>{{ __(\Carbon\Carbon::parse($model->funcionario->data_de_nascimento)->format('d/m/Y'))  }}</strong>
                        </div>

                        <div class="col-md-6">
                            E-Mail: <strong>{{ __($model->funcionario->email)  }}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Telefone: <strong>{{ __($model->funcionario->telefone)  }}</strong>
                        </div>

                        <div class="col-md-9">
                            Observação: <strong>{{ __($model->funcionario->observacao)  }}</strong>
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
                    <div class="row">
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('editar_funcionario', ['id' => $model->funcionario->id ]) }}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar </a>
                            <a href="#" class="btn btn-danger btn-sm btn-excluir" id-funcionario="{{ $model->funcionario->id }}"> <i class="far fa-trash-alt"></i> Excluir </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Lotação') }}</div>

                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12">
                        @if(Count($model->lotacoes) > 0)
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Data de Início da Lotação</th>
                                <th scope="col">Data do Fim da Lotação</th>
                                
                                <th scope="col"></th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($model->lotacoes as $lotacao)
                            <tr>
                                <td scope="row">{{ __($lotacao->id) }}</td>
                                <td>{{ __(\Carbon\Carbon::parse($lotacao->data_de_inicio)->format('d/m/Y')) }}</td>
                                <td>{{ __($lotacao->data_de_fim ? \Carbon\Carbon::parse($lotacao->data_de_fim)->format('d/m/Y') : "" ) }}</td>
                                
                                <td class="text-right">
                                    <a href="{{ route('exibir_funcionario', [$lotacao->id]) }}" class="btn btn-success btn-sm"><i class="far fa-file-archive"></i> &nbsp; Finalizar Lotação</a>
                                    <a href="{{ route('exibir_funcionario', [$lotacao->id]) }}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> &nbsp; Editar</a>
                                    <a href="{{ route('exibir_funcionario', [$lotacao->id]) }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> &nbsp; Excluir</a>
                                 </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                        @else                        
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atenção: </strong> Não existe nenhuma lotação cadastrada para o Funcionário!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                        
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('nova_lotacao', ['funcionario_id' => $model->funcionario->id]) }}" class="btn btn-primary btn-sm btn-cadastrar-lotacao"> <i class="far fa-file-alt"></i> Cadastrar </a>
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


<!-- Modal Excluir Funcionario -->
<div class="modal fade" id="ModalExcluir" tabindex="-1" role="dialog" aria-labelledby="TituloModalExcluir" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalExcluir"><i class="fas fa-exclamation-circle"></i> Excluir!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Deseja Excluir o Cadastro?</p>
            </div>
            <div class="modal-footer">
                <a id="url-modal-excluir" href="#" class="btn btn-danger"> <i class="far fa-trash-alt"></i> Confirmar e Excluir</a>
                <button type="button" class="btn btn-dark" data-dismiss="modal"> <i class="fas fa-ban"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $('.btn-excluir').on('click', function() {
        var id = $(this).attr('id-funcionario');
        $('#url-modal-excluir').attr('href', '/funcionarios/excluir/' + id);
        $('#ModalExcluir').modal('show');
    });
</script>
@endsection