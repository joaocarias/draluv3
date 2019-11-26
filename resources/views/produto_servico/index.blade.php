<?php

use App\Lib\TipoProdutoServico;

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Produtos e Serviços</h1>
        </div>
        <div class="col-md-12 text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produtos e Serviços</li>
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

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('novo_produto_servico') }}" class="btn btn-primary">
                        Cadastrar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista de Produtos e Serviços') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Valor</th>                                        
                                        <th scope="col">Observação</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{ TipoProdutoServico::getStringTipo($item->tipo) }}</td>
                                        <td>{{ 'R$ ' . number_format($item->valor_base, 2, ',', '.') }}</td>
                                        <td>{{ $item->observacao }}                                        
                                        <td class="text-right">                                            
                                            <a href="{{ route('editar_produto_servico', ['id' => $item->id ]) }}" class="btn btn-primary btn-sm">Editar</a> &nbsp;
                                            <a href="#" class="btn btn-danger btn-sm btn-excluir" id-produto-servico="{{ $item->id }}">Excluir</a>
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
    </div>
</div>

<!-- Modal Excluir -->
<div class="modal fade" id="ModalExcluir" tabindex="-1" role="dialog" aria-labelledby="TituloModalExcluir" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalExcluir">Excluir Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Deseja Excluir Cadastro?</p>
            </div>
            <div class="modal-footer">
                <a id="url-modal-excluir" href="#" class="btn btn-danger">Excluir Cadastro</a>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $('.btn-excluir').on('click', function() {
        var id = $(this).attr('id-produto-servico');
        $('#url-modal-excluir').attr('href', '/produtoseservicos/excluir/' + id);
        $('#ModalExcluir').modal('show');
    });
</script>
@endsection