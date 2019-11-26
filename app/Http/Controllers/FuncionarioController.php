<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Endereco;
use Illuminate\Support\Facades\Auth;
use App\Lib\Auxiliar;
use App\Log;
use App\Models\Funcionario\EditarFuncionarioViewModel;
use App\Models\Funcionario\ShowFuncionarioViewModel;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.index', ['model' => $funcionarios]);
    }

    public function create()
    {
        return view('funcionario.create', ['model' => null]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
            'genero' => 'required',
            'data_de_nascimento' => 'required|date_format:d/m/Y',
            'logradouro' => 'required|min:3|max:254',
            'cidade' => 'required|min:3|max:254',
            'uf' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
            'genero.required' => 'Campo Obrigatório!',
            'data_de_nascimento.date_format' => 'Informe uma data válida2!',
            'logradouro.required' => 'Campo Obrigatório!',
            'logradouro.min' => 'É necessário no mínimo 3 caracteres!',
            'cidade.required' => 'Campo Obrigatório!',
            'cidade.min' => 'É necessário no mínimo 3 caracteres!',
            'uf.required' => 'Campo Obrigatório!',
        ];

        $request->validate($regras, $messagens);

        $endereco = new Endereco();
        $endereco->cep = $request->input('cep');
        $endereco->logradouro = $request->input('logradouro');
        $endereco->numero = $request->input('numero');
        $endereco->bairro = $request->input('bairro');
        $endereco->complemento = $request->input('complemento');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->usuario_cadastro = Auth::user()->id;
        $endereco->save();

        $funcionario = new Funcionario();
        $funcionario->cpf = $request->input('cpf');
        $funcionario->nome = $request->input('nome');
        $funcionario->genero = $request->input('genero');
        $funcionario->data_de_nascimento = Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'));
        $funcionario->email = $request->input('email');
        $funcionario->telefone = $request->input('telefone');
        $funcionario->observacao = $request->input('observacao');
        $funcionario->usuario_cadastro = Auth::user()->id;
        $funcionario->endereco_id = $endereco->id;
        $funcionario->save();

        return redirect()->route('exibir_funcionario', ['id' => $funcionario->id])->withStatus(__('Cadastro Realizado com Sucesso!'));
    }

    public function show($id)
    {
        $model = new ShowFuncionarioViewModel();

        $funcionario = Funcionario::find($id);
        if (isset($funcionario)) {
            $model->setFuncionario($funcionario);

            $endereco = Endereco::Find($funcionario->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('funcionario.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = new EditarFuncionarioViewModel();

        $funcionario = Funcionario::find($id);
        if (isset($funcionario)) {
            $model->setFuncionario($funcionario);

            $endereco = Endereco::Find($funcionario->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('funcionario.edit', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
            'genero' => 'required',
            'data_de_nascimento' => 'required|date_format:d/m/Y',
            'logradouro' => 'required|min:3|max:254',
            'cidade' => 'required|min:3|max:254',
            'uf' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
            'genero.required' => 'Campo Obrigatório!',
            'data_de_nascimento.date_format' => 'Informe uma data válida2!',
            'logradouro.required' => 'Campo Obrigatório!',
            'logradouro.min' => 'É necessário no mínimo 3 caracteres!',
            'cidade.required' => 'Campo Obrigatório!',
            'cidade.min' => 'É necessário no mínimo 3 caracteres!',
            'uf.required' => 'Campo Obrigatório!',
        ];

        $request->validate($regras, $messagens);

        $model = new ShowFuncionarioViewModel();

        $funcionario = Funcionario::find($id);
        if (isset($funcionario)) {
            $model->setFuncionario($funcionario);

            $stringLog = "";
                      
            if($funcionario->cpf != $request->input('cpf')){                
                $stringLog = $stringLog . " - cpf: " . $funcionario->cpf;
                $funcionario->cpf = $request->input('cpf');
            }

            if($funcionario->nome != $request->input('nome')){
                $funcionario->nome = $request->input('nome');
                $stringLog = $stringLog . " - nome: " . $funcionario->nome;
            }

            if($funcionario->genero != $request->input('genero')){
                $stringLog = $stringLog . " - genero: " . $funcionario->genero;
                $funcionario->genero = $request->input('genero');                
            }

            if($funcionario->data_de_nascimento != Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'))){
                $stringLog = $stringLog . " - data_de_nascimento: " . $funcionario->data_de_nascimento;
                $funcionario->data_de_nascimento = Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'));
            }

            if($funcionario->email != $request->input('email')){
                $stringLog = $stringLog . " - email: " . $funcionario->email;
                $funcionario->email = $request->input('email');
            }

            if($funcionario->telefone != $request->input('telefone')){
                $stringLog = $stringLog . " - telefone: " . $funcionario->telefone;
                $funcionario->telefone = $request->input('telefone');
            }

            if($funcionario->observacao != $request->input('observacao')){
                $stringLog = $stringLog . " - observacao: " . $funcionario->observacao;
                $funcionario->observacao = $request->input('observacao');
            }
            
            $funcionario->save();

            if($stringLog != ""){
                $log = new Log();
                $log->tabela = "funcionarios";
                $log->tabela_id = $funcionario->id;
                $log->acao = "EDICAO";
                $log->descricao = $stringLog;
                $log->usuario_id = Auth::user()->id;
                $log->save();
            }

            $endereco = Endereco::Find($funcionario->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);

                $stringLog = "";
                if($endereco->cep != $request->input('cep')){
                    $stringLog = $stringLog . " - cep: " . $endereco->cep;
                    $endereco->cep = $request->input('cep');
                }

                if($endereco->logradouro != $request->input('logradouro')){
                    $stringLog = $stringLog . " - logradouro: " . $endereco->logradouro;
                    $endereco->logradouro = $request->input('logradouro');
                }

                if($endereco->numero != $request->input('numero')){
                    $stringLog = $stringLog . " - numero: " . $endereco->numero;
                    $endereco->numero = $request->input('numero');
                }

                if($endereco->bairro != $request->input('bairro')){
                    $stringLog = $stringLog . " - bairro: " . $endereco->bairro;
                    $endereco->bairro = $request->input('bairro');
                }

                if($endereco->complemento != $request->input('complemento')){
                    $stringLog = $stringLog . " - complemento: " . $endereco->complemento;
                    $endereco->complemento = $request->input('complemento');
                }

                if($endereco->cidade != $request->input('cidade')){
                    $stringLog = $stringLog . " - cidade: " . $endereco->cidade;
                    $endereco->cidade = $request->input('cidade');
                }

                if($endereco->uf != $request->input('uf')){
                    $stringLog = $stringLog . " - uf: " . $endereco->uf;
                    $endereco->uf = $request->input('uf');
                }

                $endereco->save();

                if($stringLog != ""){
                    $log = new Log();
                    $log->tabela = "enderecos";
                    $log->tabela_id = $endereco->id;
                    $log->acao = "EDICAO";
                    $log->descricao = $stringLog;
                    $log->usuario_id = Auth::user()->id;
                    $log->save();
                }
            }
        }

        return view('funcionario.show', ['model' => $model]);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);
        if (isset($funcionario)) {
            $funcionario->delete();

            $log = new Log();
            $log->tabela = "funcionarios";
            $log->tabela_id = $id;
            $log->acao = "EXCLUSAO";
            $log->descricao = "EXCLUSAO";
            $log->usuario_id = Auth::user()->id;
            $log->save();
            
            return redirect()->route('funcionarios')->withStatus(__('Cadastro Excluído com Sucesso!'));
        }

        return redirect()->route('funcionarios')->withStatus(__('Cadastro Não Excluído!'));
    }
}
