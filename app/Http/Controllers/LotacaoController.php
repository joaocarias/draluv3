<?php

namespace App\Http\Controllers;

use App\Funcao;
use App\Funcionario;
use App\Lotacao;
use Illuminate\Http\Request;
use App\Models\Lotacao\CreateLotacaoViewModel;
use Illuminate\Support\Facades\Auth;
use App\Lib\Auxiliar;

class LotacaoController extends Controller
{
    public function create($funcionario_id)
    {
        $funcionario = Funcionario::find($funcionario_id);
        $funcoes = Funcao::orderby('nome')->get();
        $model = new CreateLotacaoViewModel();
        $model->setFuncionario($funcionario);
        $model->setFuncoes($funcoes);
        return view('lotacao.create', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $regras = [
            'funcionario_id' => 'required',
            'funcao_id' => 'required',
            'data_de_inicio' => 'required|date_format:d/m/Y',            
        ];

        $messagens = [
            'funcao_id.required' => 'Campo Obrigatório!',
            'data_de_inicio.date_format' => 'Informe uma data válida!',            
        ];

        $request->validate($regras, $messagens);

        $lotacao = new Lotacao();
        $lotacao->funcionario_id = $request->input('funcionario_id');
        $lotacao->funcao_id = $request->input('funcao_id');
        $lotacao->data_de_inicio =  Auxiliar::converterDataParaUSA($request->input('data_de_inicio'));
        $lotacao->usuario_cadastro = Auth::user()->id;
        $lotacao->save();

        return redirect()->action('FuncionarioController@show', ['id' => $lotacao->funcionario_id])->withStatus(__('Cadastro Realizado com Sucesso!'));
    }
   
    public function edit($id)
    {
        
    }
  
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
