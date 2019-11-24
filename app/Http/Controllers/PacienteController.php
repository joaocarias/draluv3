<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Models\Paciente\PacientesViewModel;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente\ShowPacienteViewModel;
use App\Lib\Auxiliar;
use App\Models\Paciente\EditarPacienteViewModel;
use App\Log;

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
            ->orWhere('cpf', 'like', "%" . $filtro . "%")
            ->orWhere('ficha_id', 'like', "%" . $filtro . "%")
            ->orderBy('nome', 'asc')
            ->get();

        $model->setPacientesFiltro($pacientesFiltro);

        return view('paciente.index', ['model' => $model]);
    }

    public function create()
    {
        return view('paciente.create', ['model' => null]);
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
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('paciente.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = new EditarPacienteViewModel();

        $paciente = Paciente::find($id);
        if (isset($paciente)) {
            $model->setPaciente($paciente);

            $endereco = Endereco::Find($paciente->endereco_id);
            if (isset($endereco)) {
                $model->setEndereco($endereco);
            }
        } else {
            $model->setMensagem('Cadastro não Encontrado!');
        }

        return view('paciente.edit', ['model' => $model]);
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

        $model = new ShowPacienteViewModel();

        $paciente = Paciente::find($id);
        if (isset($paciente)) {
            $model->setPaciente($paciente);

            $stringLog = "";
            
            if($paciente->ficha_id != $request->input('ficha_id')){
                $stringLog = $stringLog . " - ficha_id: " . $paciente->ficha_id;
                $paciente->ficha_id = $request->input('ficha_id');                
            }
            
            if($paciente->cpf != $request->input('cpf')){                
                $stringLog = $stringLog . " - cpf: " . $paciente->cpf;
                $paciente->cpf = $request->input('cpf');
            }

            if($paciente->nome != $request->input('nome')){
                $paciente->nome = $request->input('nome');
                $stringLog = $stringLog . " - nome: " . $paciente->nome;
            }

            if($paciente->genero != $request->input('genero')){
                $stringLog = $stringLog . " - genero: " . $paciente->genero;
                $paciente->genero = $request->input('genero');                
            }

            if($paciente->data_de_nascimento != Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'))){
                $stringLog = $stringLog . " - data_de_nascimento: " . $paciente->data_de_nascimento;
                $paciente->data_de_nascimento = Auxiliar::converterDataParaUSA($request->input('data_de_nascimento'));
            }

            if($paciente->email != $request->input('email')){
                $stringLog = $stringLog . " - email: " . $paciente->email;
                $paciente->email = $request->input('email');
            }

            if($paciente->telefone != $request->input('telefone')){
                $stringLog = $stringLog . " - telefone: " . $paciente->telefone;
                $paciente->telefone = $request->input('telefone');
            }

            if($paciente->observacao != $request->input('observacao')){
                $stringLog = $stringLog . " - observacao: " . $paciente->observacao;
                $paciente->observacao = $request->input('observacao');
            }
            
            $paciente->save();

            if($stringLog != ""){
                $log = new Log();
                $log->tabela = "pacientes";
                $log->tabela_id = $paciente->id;
                $log->acao = "EDICAO";
                $log->descricao = $stringLog;
                $log->usuario_id = Auth::user()->id;
                $log->save();
            }

            $endereco = Endereco::Find($paciente->endereco_id);
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

        return view('paciente.show', ['model' => $model]);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        if (isset($paciente)) {
            $paciente->delete();

            $log = new Log();
            $log->tabela = "pacientes";
            $log->tabela_id = $id;
            $log->acao = "EXCLUSAO";
            $log->descricao = "EXCLUSAO";
            $log->usuario_id = Auth::user()->id;
            $log->save();
        }
        return redirect()->route('pacientes')->withStatus(__('Cadastro Excluído com Sucesso!'));;
    }
}
