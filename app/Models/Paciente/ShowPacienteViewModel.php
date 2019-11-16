<?php 

namespace App\Models\Paciente;

class ShowPacienteViewModel
{
    public $paciente;
    public $endereco;
    public $mensagem;

    function __construct($paciente = null, $endereco = null, $mensagem = null)
    {
        $this->paciente = $paciente;
        $this->endereco = $endereco; 
        $this->mensagem = $mensagem;
    }

    function getPaciente(){
        return $this->paciente;
    }

    function setPaciente($value){
        $this->paciente = $value;
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
}