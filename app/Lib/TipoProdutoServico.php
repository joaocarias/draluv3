<?php

namespace App\Lib;

class TipoProdutoServico 
{
    public static function getStringTipo($valeu){
        if($valeu == "P"){
            return 'Produto';
        }else if($valeu == "S"){
            return 'Serviço';
        }else{
            return "";
        }
    }
}