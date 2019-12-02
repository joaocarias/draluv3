@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Fornecedor</h1>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> &nbsp; Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fornecedores') }}">Fornecedores</a></li>
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

    @if(isset($model->fornecedor) && ($model->fornecedor->id > 0) )

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Detalhes') }}</div>

                <div class="card-body">
                    <div class="row">                      

                        <div class="col-md-3">
                            CPF/CNPJ: <strong>{{ __($model->fornecedor->cpf_cnpj)  }}</strong>
                        </div>

                        <div class="col-md-6">
                            Nome: <strong>{{ __($model->fornecedor->nome_social)  }}</strong>
                        </div>

                        <div class="col-md-3">
                            Nº de Inscrição: <strong>{{ __($model->fornecedor->inscricao)  }}</strong>
                        </div>
                    </div>

                    <div class="row">                       
                        <div class="col-md-3">
                            Telefone: <strong>{{ __($model->fornecedor->telefone)  }}</strong>
                        </div>

                        <div class="col-md-4">
                            E-Mail: <strong>{{ __($model->fornecedor->email)  }}</strong>
                        </div>
                   
                        <div class="col-md-4">
                            Observação: <strong>{{ __($model->fornecedor->observacao)  }}</strong>
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
                            <a href="{{ route('editar_fornecedor', ['id' => $model->fornecedor->id ]) }}" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Editar </a>
                            <a href="#" class="btn btn-danger btn-sm btn-excluir" id-fornecedor="{{ $model->fornecedor->id }}"> <i class="far fa-trash-alt"></i> Excluir </a>  
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


<!-- Modal Excluir -->
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
        var id = $(this).attr('id-fornecedor');
        $('#url-modal-excluir').attr('href', '/fornecedores/excluir/' + id);
        $('#ModalExcluir').modal('show');
    });
</script>
@endsection