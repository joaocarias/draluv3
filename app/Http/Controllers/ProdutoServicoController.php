<?php

namespace App\Http\Controllers;

use App\ProdutoServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;

class ProdutoServicoController extends Controller
{
    public function index()
    {
        $model = ProdutoServico::all();
        return view('produto_servico.index', ['model' => $model]);
    }

    public function create()
    {
        return view('produto_servico.create', ['model' => null]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
            'tipo' => 'required',
            'valor_base' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
            'tipo.required' => 'Campo Obrigatório!',
            'valor_base.required' => 'Campo Obrigatório!',
        ];

        $request->validate($regras, $messagens);

        $produtoServico = new ProdutoServico();
        $produtoServico->tipo = $request->input('tipo');
        $produtoServico->nome = $request->input('nome');
        $produtoServico->valor_base = str_replace(',', '.', $request->input('valor_base'));
        $produtoServico->observacao = $request->input('observacao');
        $produtoServico->usuario_cadastro = Auth::user()->id;
        $produtoServico->save();

        return redirect()->route('produtoseservicos')->withStatus(__('Cadastro Realizado com Sucesso!'));
    }

    public function edit($id)
    {
        $produtoServico = ProdutoServico::find($id);
        return view('produto_servico.edit', ['model' => $produtoServico]);
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
            'tipo' => 'required',
            'valor_base' => 'required',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
            'tipo.required' => 'Campo Obrigatório!',
            'valor_base.required' => 'Campo Obrigatório!',
        ];

        $request->validate($regras, $messagens);

        $produtoServico = ProdutoServico::find($id);
        if (isset($produtoServico)) {
            $stringLog = "";
            
            if($produtoServico->tipo != $request->input('tipo')){                
                $stringLog = $stringLog . " - tipo: " . $produtoServico->tipo;
                $produtoServico->tipo = $request->input('tipo');
            }

            if($produtoServico->nome != $request->input('nome')){                
                $stringLog = $stringLog . " - nome: " . $produtoServico->nome;
                $produtoServico->nome = $request->input('nome');
            }

            if($produtoServico->valor_base != str_replace(',', '.', $request->input('valor_base'))){                
                $stringLog = $stringLog . " - valor_base: " . $produtoServico->valor_base;
                $produtoServico->valor_base = str_replace(',', '.', $request->input('valor_base'));
            }

            if($produtoServico->observacao != $request->input('observacao')){                
                $stringLog = $stringLog . " - observacao: " . $produtoServico->observacaopo;
                $produtoServico->observacao = $request->input('observacao');
            }
            
            $produtoServico->save();

            if($stringLog != ""){
                $log = new Log();
                $log->tabela = "produto_servicos";
                $log->tabela_id = $produtoServico->id;
                $log->acao = "EDICAO";
                $log->descricao = $stringLog;
                $log->usuario_id = Auth::user()->id;
                $log->save();
            }

            return redirect()->route('produtoseservicos')->withStatus(__('Cadastro Atualizado com Sucesso!'));
        }

        
        return redirect()->route('produtoseservicos')->withStatus(__('Cadastro não Atualizado!'));
    }

    public function destroy($id)
    { 
        $produtoServico = ProdutoServico::find($id);
        if (isset($produtoServico)) {
            $produtoServico->delete();

            $log = new Log();
            $log->tabela = "produto_servicos";
            $log->tabela_id = $id;
            $log->acao = "EXCLUSAO";
            $log->descricao = "EXCLUSAO";
            $log->usuario_id = Auth::user()->id;
            $log->save();
            
            return redirect()->route('produtoseservicos')->withStatus(__('Cadastro Excluído com Sucesso!'));
        }

        return redirect()->route('produtoseservicos')->withStatus(__('Cadastro Não Excluído!'));
    }
}
