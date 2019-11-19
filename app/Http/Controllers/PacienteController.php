<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Models\Paciente\PacientesViewModel;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente\ShowPacienteViewModel;
use App\Lib\Auxiliar;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $model = new PacientesViewModel();

        $pacientesRecentes = Paciente::orderBy('created_at', 'desc')->take(10)->get();
        $model->setPacientesRecentes($pacientesRecentes);

        $filtro = $request->input('filtro');
        $model->setFiltro($filtro);

        $pacientesFiltro = Paciente::where('nome', 'like', "%" . $filtro . "%")
                ->orWhere('cpf','like', "%" . $filtro . "%")
                ->orWhere('ficha_id','like', "%" . $filtro . "%")
                ->orderBy('nome', 'asc')
                ->get();

        $model->setPacientesFiltro($pacientesFiltro);

        return view('paciente.index', [ 'model' => $model ]);
    }

    public function create()
    {
        return view('paciente.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:254',
            'gereno' => 'required',
            'data_de_nascimento' => 'required|date|date_format:d-m-Y',
            'logradouro' => 'required|min:3|max:254',
            'cidade' => 'required|min:3|max:254',
            'genero' => 'required',
            
        ];

        $messagens = [
            'required' => 'O atributo :attribute é obrigatório!',
            'nome.required' => 'O nome é requerido',
            'nome.min' => 'É necessário no mínimo 3 caracteres',
            'genero.required' => 'Campo Obrigatório', 
            'data_de_nascimento.date' => 'Informe uma data válida',
            'data_de_nascimento.date_format' => 'Informe uma data válida',            
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

        $paciente = new Paciente();
        $paciente->ficha_id = $request->input('ficha_id');
        $paciente->cpf = $request->input('cpf');
        $paciente->nome = $request->input('nome');
        $paciente->genero = $request->input('genero');
        $paciente->data_de_nascimento = Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'));
        $paciente->email = $request->input('email');
        $paciente->telefone = $request->input('telefone');
        $paciente->observacao = $request->input('observacao');
        $paciente->usuario_cadastro = Auth::user()->id;
        $paciente->endereco_id = $endereco->id;
        $paciente->save();

        return redirect()->route('exibir_paciente', ['id' => $paciente->id])->withStatus(__('Cadastro Realizado com Sucesso!'));
    }
    
    public function show($id)
    {
        $model = new ShowPacienteViewModel();

        $paciente = Paciente::find($id);        
        if (isset($paciente)) {
            $model->setPaciente($paciente);

            $endereco = Endereco::Find($paciente->endereco_id);
            if(isset($endereco)){
                $model->setEndereco($endereco);
            }            
        }else{
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('paciente.show', [ 'model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        if (isset($paciente)) {
            $paciente->delete();
        }
        return redirect()->route('pacientes')->withStatus(__('Cadastro Excluído com Sucesso!'));;       
    }
}
