<div class="form-group row">
    <div class="col-md-3">
        <label for="cpf_cnpj" class="col-form-label">{{ __('CPF/CNPJ') }}</label>
        <input id="cpf_cnpj" type="text" class="mask_cpf_cnpj form-control @error('cpf_cnpj') is-invalid @enderror" name="cpf_cnpj" value="{{ old('cpf_cnpj', $model->fornecedor->cpf_cnpj ?? '' ) }}" autocomplete="cpf_cnpj">

        @error('cpf_cnpj')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nome_social" class="col-form-label">{{ __('* Nome Social') }}</label>
        <input id="nome_social" type="text" class="form-control @error('nome_social') is-invalid @enderror" name="nome_social" value="{{ old('nome_social', $model->fornecedor->nome_social ?? '') }}" required autocomplete="nome_social" maxlength="254">

        @error('nome_social')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="inscricao" class="col-form-label">{{ __('Nº Inscricao') }}</label>
        <input id="inscricao" type="text" class="form-control @error('inscricao') is-invalid @enderror" name="inscricao" value="{{ old('inscricao', $model->fornecedor->inscricao ?? '') }}" autocomplete="inscricao" maxlength="29">

        @error('inscricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

</div>


<div class="form-group row">
    <div class="col-md-3">
        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $model->fornecedor->email ?? '') }}" autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="telefone" class="col-form-label">{{ __('Telefone') }}</label>
        <input id="telefone" type="text" class="mask_telefone form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone', $model->fornecedor->telefone ?? '') }}" autocomplete="telefone">

        @error('telefone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="observacao" class="col-form-label text-md-right">{{ __('Observação') }}</label>
        <input id="observacao" type="text" class="form-control @error('observacao') is-invalid @enderror" name="observacao" value="{{ old('observacao', $model->fornecedor->observacao ?? '') }}" autocomplete="observacao">

        @error('observacao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>