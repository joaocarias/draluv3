<?php
use App\Lib\Genero;
use App\Lib\Auxiliar;

?>

<div class="form-group row">    
    <div class="col-md-3">
        <label for="cpf" class="col-form-label">{{ __('CPF') }}</label>

        <input id="cpf" type="text" class="mask_cpf form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf', $model->funcionario->cpf ?? '' ) }}" autocomplete="cpf">

        @error('cpf')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-9">
        <label for="nome" class="col-form-label">{{ __('* Nome Completo') }}</label>

        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome', $model->funcionario->nome ?? '') }}" required autocomplete="nome" maxlength="254">

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
            <option value="F" @if ( old('genero', $model->funcionario->genero ?? '' ) == "F" ) {{ 'selected' }} @endif>{{ __(Genero::getStringGenero('F')) }}</option>
            <option value="M" @if ( old('genero', $model->funcionario->genero ?? '' ) == "M" ) {{ 'selected' }} @endif>{{ __(Genero::getStringGenero('M')) }}</option>
        </select>

        @error('genero')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3">        
        <label for="data_de_nascimento" class="col-form-label">{{ __('* Data de Nascimento') }}</label>
        <?php 
            $dataDeNascimento =  (!isset($model->funcionario) or is_null($model->funcionario) or $model->funcionario->data_de_nascimento == "") ? null : Auxiliar::converterDataParaBR($model->funcionario->data_de_nascimento) ;            
        ?>        
        <input id="data_de_nascimento" type="text" class="mask_data form-control @error('data_de_nascimento') is-invalid @enderror" name="data_de_nascimento" value="{{ old('data_de_nascimento', $dataDeNascimento ?? '') }}" autocomplete="data_de_nascimento" required>

        @error('data_de_nascimento')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $model->funcionario->email ?? '') }}" autocomplete="email">

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
        <input id="telefone" type="text" class="mask_telefone form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone', $model->funcionario->telefone ?? '') }}" autocomplete="telefone">

        @error('telefone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-9">
        <label for="observacao" class="col-form-label text-md-right">{{ __('Observação') }}</label>
        <input id="observacao" type="text" class="form-control @error('observacao') is-invalid @enderror" name="observacao" value="{{ old('observacao', $model->funcionario->observacao ?? '') }}" autocomplete="observacao">

        @error('observacao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>