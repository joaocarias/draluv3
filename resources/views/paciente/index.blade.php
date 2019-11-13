@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Paciente</h1>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Paciente</li>
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
                <div class="col-md-12 text-right">
                    <a href="{{ route('novo_paciente') }}" class="btn btn-primary btn-sm">
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
                <div class="card-header">{{ __('Pesquisar') }}</div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
