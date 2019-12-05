<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcao;
use Illuminate\Support\Facades\Auth;
use App\Log;

class FuncaoController extends Controller
{
    public function index()
    {
        $model = Funcao::all();
        return view('funcao.index', ['model' => $model]); 
    }

    public function create()
    {
        return view('funcao.create', ['model' => null]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
        ];

        $request->validate($regras, $messagens);

        $obj = new Funcao();
        $obj->nome = $request->input('nome');
        $obj->observacao = $request->input('observacao');
        $obj->usuario_cadastro = Auth::user()->id;
        $obj->save();

        return redirect()->route('funcoes')->withStatus(__('Cadastro Realizado com Sucesso!'));    
    }

    public function edit($id)
    {
        $obj = Funcao::find($id);
        return view('funcao.edit', ['model' => $obj]);
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
        ];

        $messagens = [
            'required' => 'Campo Obrigatório!',
            'nome.required' => 'Campo Obrigatório!',
            'nome.min' => 'É necessário no mínimo 3 caracteres!',
        ];

        $request->validate($regras, $messagens);

        $obj = Funcao::find($id);
        if (isset($obj)) {
            $stringLog = "";
        
            if($obj->nome != $request->input('nome')){                
                $stringLog = $stringLog . " - nome: " . $obj->nome;
                $obj->nome = $request->input('nome');
            }

            if($obj->observacao != $request->input('observacao')){                
                $stringLog = $stringLog . " - observacao: " . $obj->observacao;
                $obj->observacao = $request->input('observacao');
            }
            
            $obj->save();

            if($stringLog != ""){
                $log = new Log();
                $log->tabela = "funcaos";
                $log->tabela_id = $obj->id;
                $log->acao = "EDICAO";
                $log->descricao = $stringLog;
                $log->usuario_id = Auth::user()->id;
                $log->save();
            }

            return redirect()->route('funcoes')->withStatus(__('Cadastro Atualizado com Sucesso!'));
        }
       
        return redirect()->route('funcoes')->withStatus(__('Cadastro não Atualizado!'));
    }

    public function destroy($id)
    {
        $obj = Funcao::find($id);
        if (isset($obj)) {
            $obj->delete();

            $log = new Log();
            $log->tabela = "funcaos";
            $log->tabela_id = $id;
            $log->acao = "EXCLUSAO";
            $log->descricao = "EXCLUSAO";
            $log->usuario_id = Auth::user()->id;
            $log->save();
            
            return redirect()->route('funcoes')->withStatus(__('Cadastro Excluído com Sucesso!'));
        }

        return redirect()->route('funcoes')->withStatus(__('Cadastro Não Excluído!'));
    }
}
