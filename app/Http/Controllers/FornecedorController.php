<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor\FornecedoresViewModel;
use App\Models\Fornecedor\ShowFornecedorViewModel;
use App\Models\Fornecedor\EditarFornecedorViewModel;
use App\Fornecedor;
use App\Endereco;
use Illuminate\Support\Facades\Auth;
use App\Log;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedor.index', ['model' => $fornecedores]); 
    }

    public function create()
    {
        return view('fornecedor.create', ['model' => null]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome_social' => 'required|min:3|max:254',
            'logradouro' => 'required|min:3|max:254',
            'cidade' => 'required|min:3|max:254',
            'uf' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
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

        $fornecedor = new Fornecedor();
        $fornecedor->nome_social = $request->input('nome_social');
        $fornecedor->cpf_cnpj = $request->input('cpf_cnpj');
        $fornecedor->inscricao = $request->input('inscricao');
        $fornecedor->email = $request->input('email');
        $fornecedor->telefone = $request->input('telefone');
        $fornecedor->observacao = $request->input('observacao');
        $fornecedor->usuario_cadastro = Auth::user()->id;
        $fornecedor->endereco_id = $endereco->id;
        $fornecedor->save();

        return redirect()->route('exibir_fornecedor', ['id' => $fornecedor->id])->withStatus(__('Cadastro Realizado com Sucesso!'));
    }

    public function show($id)
    {
        $model = new ShowFornecedorViewModel();

        $fornecedor = Fornecedor::find($id);
        if (isset($fornecedor)) {
            $model->setFornecedor($fornecedor);

            $endereco = Endereco::Find($fornecedor->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('fornecedor.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = new EditarFornecedorViewModel();

        $fornecedor = fornecedor::find($id);
        if (isset($fornecedor)) {
            $model->setFornecedor($fornecedor);

            $endereco = Endereco::Find($fornecedor->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('fornecedor.edit', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome_social' => 'required|min:3|max:254',
            'logradouro' => 'required|min:3|max:254',
            'cidade' => 'required|min:3|max:254',
            'uf' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
            'logradouro.required' => 'Campo Obrigatório!',
            'logradouro.min' => 'É necessário no mínimo 3 caracteres!',
            'cidade.required' => 'Campo Obrigatório!',
            'cidade.min' => 'É necessário no mínimo 3 caracteres!',
            'uf.required' => 'Campo Obrigatório!',
        ];

        $request->validate($regras, $messagens);

        $model = new ShowFornecedorViewModel();

        $fornecedor = Fornecedor::find($id);
        if (isset($fornecedor)) {
            $model->setFornecedor($fornecedor);

            $stringLog = "";
                    
            if($fornecedor->nome_social != $request->input('nome_social')){                
                $stringLog = $stringLog . " - nome_social: " . $fornecedor->cnome_socialpf;
                $fornecedor->nome_social = $request->input('nome_social');
            }

            if($fornecedor->cpf_cnpj != $request->input('cpf_cnpj')){
                $stringLog = $stringLog . " - cpf_cnpj: " . $fornecedor->cpf_cnpj;
                $fornecedor->cpf_cnpj = $request->input('cpf_cnpj');
            }

            if($fornecedor->inscricao != $request->input('inscricao')){
                $stringLog = $stringLog . " - inscricao: " . $fornecedor->inscricao;
                $fornecedor->inscricao = $request->input('inscricao');                
            }
        
            if($fornecedor->email != $request->input('email')){
                $stringLog = $stringLog . " - email: " . $fornecedor->email;
                $fornecedor->email = $request->input('email');
            }

            if($fornecedor->telefone != $request->input('telefone')){
                $stringLog = $stringLog . " - telefone: " . $fornecedor->telefone;
                $fornecedor->telefone = $request->input('telefone');
            }

            if($fornecedor->observacao != $request->input('observacao')){
                $stringLog = $stringLog . " - observacao: " . $fornecedor->observacao;
                $fornecedor->observacao = $request->input('observacao');
            }
            
            $fornecedor->save();

            if($stringLog != ""){
                $log = new Log();
                $log->tabela = "fornecedors";
                $log->tabela_id = $fornecedor->id;
                $log->acao = "EDICAO";
                $log->descricao = $stringLog;
                $log->usuario_id = Auth::user()->id;
                $log->save();
            }

            $endereco = Endereco::Find($fornecedor->endereco_id);
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

        return view('fornecedor.show', ['model' => $model]);
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);
        if (isset($fornecedor)) {
            $fornecedor->delete();

            $log = new Log();
            $log->tabela = "fornecedors";
            $log->tabela_id = $id;
            $log->acao = "EXCLUSAO";
            $log->descricao = "EXCLUSAO";
            $log->usuario_id = Auth::user()->id;
            $log->save();
            
            return redirect()->route('fornecedores')->withStatus(__('Cadastro Excluído com Sucesso!'));
        }

        return redirect()->route('fornecedores')->withStatus(__('Cadastro Não Excluído!'));
    }
}
