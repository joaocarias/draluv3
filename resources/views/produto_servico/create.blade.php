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
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produtoseservicos') }}">Produtos e Serviços</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ route('cadastrar_produto_servico') }}">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">{{ __('Cadastro') }}</div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="tipo" class="col-form-label">{{ __('* Tipo') }}</label>

                                        <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo" autocomplete="tipo" required autofocus>
                                            <option selected disabled>-- Selecione --</option>
                                            <option value="P" @if ( old('tipo', $model->tipo ?? '' ) == "P" ) {{ 'selected' }} @endif>{{ __(TipoProdutoServico::getStringTipo('P')) }}</option>
                                            <option value="S" @if ( old('tipo', $model->tipo ?? '' ) == "S" ) {{ 'selected' }} @endif>{{ __(TipoProdutoServico::getStringTipo('S')) }}</option>
                                        </select>

                                        @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nome" class="col-form-label text-md-right">{{ __('* Nome') }}</label>
                                        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome', $model->nome ?? '') }}" autocomplete="nome" required maxlength="255">

                                        @error('nome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="valor_base" class="col-form-label">{{ __('* Valor Base R$') }}</label>

                                        <input id="valor_base" type="text" class="mask_moeda form-control @error('valor_base') is-invalid @enderror" name="valor_base" value="{{ old('valor_base', $model->valor_base ?? '') }}" autocomplete="valor_base" required maxlength="12">

                                        @error('valor_base')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="observacao" class="col-form-label text-md-right">{{ __('Observação') }}</label>
                                        <input id="observacao" type="text" class="form-control @error('observacao') is-invalid @enderror" name="observacao" value="{{ old('observacao', $model->observacao ?? '') }}" autocomplete="observacao" maxlength="255">

                                        @error('observacao')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i>
                            {{ __('Salvar') }}
                        </button>

                        <a href="{{ route('produtoseservicos') }}" class="btn btn-warning">
                            <i class="far fa-times-circle"></i>
                            {{ __('Cancelar') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function($) {
        $('.mask_moeda').mask("#0,00", {reverse: true});
    });
</script>
@endsection