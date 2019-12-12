<?php 

namespace App\Models\Lotacao;

class CreateLotacaoViewModel
{
    public $funcionario;
    public $Funcoes;

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function getFuncoes()
    {
        return $this->Funcoes;
    }

    public function setFuncoes($Funcoes)
    {
        $this->Funcoes = $Funcoes;
    }
}