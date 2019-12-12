@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Lotação</h1>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('funcionarios') }}">Lotação</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ route('cadastrar_lotacao') }}">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">{{ __('Cadastro') }}</div>
                            <div class="card-body">

                                <div class="form-group row">

                                    <input id="funcionario_id" type="hidden" name="funcionario_id" value="{{ old('funcionario_id', $model->funcionario->id ?? '' ) }}">

                                    <div class="col-md-6">
                                        <label for="nome_funcionario" class="col-form-label">{{ __('* Nome Completo') }}</label>

                                        <input id="nome_funcionario" type="text" class="form-control @error('nome_funcionario') is-invalid @enderror" name="nome_funcionario" value="{{ old('nome_funcionario', $model->funcionario->nome ?? '') }}" autocomplete="nome_funcionario" maxlength="254" disabled>

                                        @error('nome_funcionario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="funcao_id" class="col-form-label">{{ __('* Função') }}</label>

                                        <select id="funcao_id" type="text" class="form-control @error('funcao_id') is-invalid @enderror" name="funcao_id" autocomplete="funcao_id" required>
                                            <option selected disabled>-- Selecione --</option>
                                            @foreach($model->getFuncoes() as $funcao)
                                            <option value="{{ __($funcao->id) }}"> {{ __($funcao->nome) }} </option>
                                            @endforeach

                                        </select>

                                        @error('funcao_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="data_de_inicio" class="col-form-label">{{ __('* Data de Lotação') }}</label>
                                        
                                        <input id="data_de_inicio" type="text" class="mask_data form-control @error('data_de_inicio') is-invalid @enderror" name="data_de_inicio" value="{{ old('data_de_inicio') }}" autocomplete="data_de_inicio" required>

                                        @error('data_de_inicio')
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

                        <a href="{{ route('exibir_funcionario', [$model->funcionario->id]) }}" class="btn btn-warning">
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
        $('.mask_data').mask('00/00/0000');
    });
</script>
@endsection