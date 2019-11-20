<div class="form-group row">
    <div class="col-md-3">
        <label for="cep" class="col-form-label">{{ __('CEP') }} </label>
        <input id="cep" type="text" class="mask_cep form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep', $model->endereco->cep ?? '') }}" autocomplete="cep">

        @error('cep')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="logradouro" class="col-form-label">{{ __('* Logradouro') }} <small>{{ __('(Rua/Av./Sítio)') }}</small></label>
        <input id="logradouro" type="text" class="form-control @error('logradouro') is-invalid @enderror" name="logradouro" value="{{ old('logradouro', $model->endereco->logradouro ?? '') }}" autocomplete="logradouro" required>

        @error('logradouro')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="numero" class="col-form-label text-md-right">{{ __('Número') }}</label>
        <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero', $model->endereco->numero ?? '') }}" autocomplete="numero">

        @error('numero')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="bairro" class="col-form-label">{{ __('Bairro') }} </small></label>
        <input id="bairro" type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro', $model->endereco->bairro ?? '') }}" autocomplete="bairro">

        @error('bairro')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="complemento" class="col-form-label text-md-right">{{ __('Complemento') }}</label>
        <input id="complemento" type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento" value="{{ old('complemento', $model->endereco->complemento ?? '') }}" autocomplete="complemento">

        @error('complemento')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="cidade" class="col-form-label text-md-right">{{ __('* Cidade') }}</label>
        <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade', $model->endereco->cidade ?? '') }}" autocomplete="cidade" required>

        @error('cidade')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="uf" class="col-form-label">{{ __('* Estado') }}</label>

        <select id="uf" type="text" class="form-control @error('uf') is-invalid @enderror" name="uf" autocomplete="uf" required>
            <option value="AC" @if ( old('uf', $model->endereco->uf ?? '')=="AC" ) {{ 'selected' }} @endif>Acre</option>
            <option value="AL" @if ( old('uf', $model->endereco->uf ?? '')=="AL" ) {{ 'selected' }} @endif>Alagoas</option>
            <option value="AP" @if ( old('uf', $model->endereco->uf ?? '')=="AP" ) {{ 'selected' }} @endif>Amapá</option>
            <option value="AM" @if ( old('uf', $model->endereco->uf ?? '')=="AM" ) {{ 'selected' }} @endif>Amazonas</option>
            <option value="BA" @if ( old('uf', $model->endereco->uf ?? '')=="BA" ) {{ 'selected' }} @endif>Bahia</option>
            <option value="CE" @if ( old('uf', $model->endereco->uf ?? '')=="CE" ) {{ 'selected' }} @endif>Ceará</option>
            <option value="DF" @if ( old('uf', $model->endereco->uf ?? '')=="DF" ) {{ 'selected' }} @endif>Distrito Federal</option>
            <option value="ES" @if ( old('uf', $model->endereco->uf ?? '')=="ES" ) {{ 'selected' }} @endif>Espírito Santo</option>
            <option value="GO" @if ( old('uf', $model->endereco->uf ?? '')=="GO" ) {{ 'selected' }} @endif>Goiás</option>
            <option value="MA" @if ( old('uf', $model->endereco->uf ?? '')=="MA" ) {{ 'selected' }} @endif>Maranhão</option>
            <option value="MT" @if ( old('uf', $model->endereco->uf ?? '')=="MT" ) {{ 'selected' }} @endif>Mato Grosso</option>
            <option value="MS" @if ( old('uf', $model->endereco->uf ?? '')=="MS" ) {{ 'selected' }} @endif>Mato Grosso do Sul</option>
            <option value="MG" @if ( old('uf', $model->endereco->uf ?? '')=="MG" ) {{ 'selected' }} @endif>Minas Gerais</option>
            <option value="PA" @if ( old('uf', $model->endereco->uf ?? '')=="PA" ) {{ 'selected' }} @endif>Pará</option>
            <option value="PB" @if ( old('uf', $model->endereco->uf ?? '')=="PB" ) {{ 'selected' }} @endif>Paraíba</option>
            <option value="PR" @if ( old('uf', $model->endereco->uf ?? '')=="PR" ) {{ 'selected' }} @endif>Paraná</option>
            <option value="PE" @if ( old('uf', $model->endereco->uf ?? '')=="PE" ) {{ 'selected' }} @endif>Pernambuco</option>
            <option value="PI" @if ( old('uf', $model->endereco->uf ?? '')=="PI" ) {{ 'selected' }} @endif>Piauí</option>
            <option value="RJ" @if ( old('uf', $model->endereco->uf ?? '')=="RJ" ) {{ 'selected' }} @endif>Rio de Janeiro</option>
            <option value="RN" @if ( old('uf', $model->endereco->uf ?? 'RN' )=="RN" ) {{ 'selected' }} @endif>Rio Grande do Norte</option>
            <option value="RS" @if ( old('uf', $model->endereco->uf ?? '')=="RS" ) {{ 'selected' }} @endif>Rio Grande do Sul</option>
            <option value="RO" @if ( old('uf', $model->endereco->uf ?? '')=="RO" ) {{ 'selected' }} @endif>Rondônia</option>
            <option value="RR" @if ( old('uf', $model->endereco->uf ?? '')=="RR" ) {{ 'selected' }} @endif>Roraima</option>
            <option value="SC" @if ( old('uf', $model->endereco->uf ?? '')=="SC" ) {{ 'selected' }} @endif>Santa Catarina</option>
            <option value="SP" @if ( old('uf', $model->endereco->uf ?? '')=="SP" ) {{ 'selected' }} @endif>São Paulo</option>
            <option value="SE" @if ( old('uf', $model->endereco->uf ?? '')=="SE" ) {{ 'selected' }} @endif>Sergipe</option>
            <option value="TO" @if ( old('uf', $model->endereco->uf ?? '')=="TO" ) {{ 'selected' }} @endif>Tocantins</option>
            <option value="EX" @if ( old('uf', $model->endereco->uf ?? '')=="EX" ) {{ 'selected' }} @endif>Estrangeiro</option>
        </select>
    </div>
</div>