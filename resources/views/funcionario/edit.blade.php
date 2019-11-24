<?php

use App\Lib\Genero;

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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('funcionarios') }}">Funcionários</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ route('update_funcionario', [ 'id' => $model->funcionario->id ]) }}">
                @csrf
                @method('put')

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">{{ __('Cadastro') }}</div>
                            <div class="card-body">
                                @include('funcionario._formfuncionario')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">{{ __('Endereço') }}</div>
                            <div class="card-body">
                                @include('endereco._formEndereco')
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

                        <a href="{{ route('funcionarios') }}" class="btn btn-warning">
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