<?php 

namespace App\Models\Fornecedor;

class EditarFornecedorViewModel
{
    public $fornecedor;
    public $endereco;
    public $mensagem;

    function __construct($fornecedor = null, $endereco = null, $mensagem = null)
    {
        $this->fornecedor = $fornecedor;
        $this->endereco = $endereco; 
        $this->mensagem = $mensagem;
    }

    function getFornecedor(){
        return $this->fornecedor;
    }

    function setFornecedor($value){
        $this->fornecedor = $value;
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