<?php 

namespace App\Models\Funcionario;

class ShowFuncionarioViewModel
{
    public $funcionario;
    public $endereco;
    public $mensagem;
    public $lotacoes;

    function __construct($funcionario = null, $endereco = null, $mensagem = null, $lotacoes = null)
    {
        $this->funcionario = $funcionario;
        $this->endereco = $endereco; 
        $this->mensagem = $mensagem;
        $this->lotacoes = $lotacoes;
    }

    function getFuncionario(){
        return $this->funcionario;
    }

    function setFuncionario($value){
        $this->funcionario = $value;
    }
        
    function getEndereco(){
        return $this->endereco;
    }

    function setEndereco($value){
        $this->endereco = $value;
    }

    function getMensagem(){
        return $this->mensagem;
    }

    function setMensagem($value){
        $this->mensagem = $value;
    }    

    public function getLotacoes()
    {
        return $this->lotacoes;
    }
     
    public function setLotacoes($lotacoes)
    {
        $this->lotacoes = $lotacoes;
    }
}