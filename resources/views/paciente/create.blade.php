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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pacientes') }}">Pacientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ route('cadastrar_paciente') }}">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">{{ __('Cadastro') }}</div>

                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="ficha_id" class="col-form-label">{{ __('Nº da Ficha') }}</label>

                                        <input id="ficha_id" type="text" class="form-control @error('ficha_id') is-invalid @enderror" name="ficha_id" value="{{ old('ficha_id') }}" autocomplete="ficha_id" autofocus>

                                        @error('ficha_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cpf" class="col-form-label">{{ __('CPF') }}</label>

                                        <input id="cpf" type="text" class="mask_cpf form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" autocomplete="cpf">

                                        @error('cpf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nome" class="col-form-label">{{ __('* Nome Completo') }}</label>

                                        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" maxlength="254">

                                        @error('nome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="genero" class="col-form-label">{{ __('* Gênero') }}</label>

                                        <select id="genero" type="text" class="form-control @error('genero') is-invalid @enderror" name="genero" autocomplete="genero" required>
                                            <option selected disabled>-- Selecione --</option>
                                            <option value="F" @if ( old('genero')=="F" ) {{ 'selected' }} @endif>{{ __(Genero::getStringGenero('F')) }}</option>
                                            <option value="M" @if ( old('genero')=="M" ) {{ 'selected' }} @endif>{{ __(Genero::getStringGenero('M')) }}</option>
                                        </select>

                                        @error('genero')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="data_de_nascimento" class="col-form-label">{{ __('* Data de Nascimento') }}</label>

                                        <input id="data_de_nascimento" type="text" class="mask_data form-control @error('data_de_nascimento') is-invalid @enderror" name="data_de_nascimento" value="{{ old('data_de_nascimento') }}" autocomplete="data_de_nascimento" required>

                                        @error('data_de_nascimento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">

                                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="telefone" class="col-form-label">{{ __('Telefone') }}</label>
                                        <input id="telefone" type="text" class="mask_telefone form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" autocomplete="telefone">

                                        @error('telefone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="col-md-9">
                                        <label for="observacao" class="col-form-label text-md-right">{{ __('Observação') }}</label>
                                        <input id="observacao" type="text" class="form-control @error('observacao') is-invalid @enderror" name="observacao" value="{{ old('observacao') }}" autocomplete="observacao">

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

                @include('endereco.pformendereco')

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i>
                            {{ __('Salvar') }}
                        </button>

                        <a href="{{ route('pacientes') }}" class="btn btn-warning">
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
        $('.mask_cpf').mask('000.000.000-00');
        $('.mask_data').mask('00/00/0000');

        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('.mask_telefone').mask(SPMaskBehavior, spOptions);

        $('.mask_cep').mask('00000-000');    

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("RN") ;           
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#logradouro").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);            
                            
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

    });
    
</script>
@endsection