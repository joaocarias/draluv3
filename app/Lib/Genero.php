<?php

namespace App\Lib;

class Genero 
{
    public static function getStringGenero($genero){
        if($genero == "M"){
            return 'Masculino';
        }else if($genero == "F"){
            return 'Feminino';
        }else{
            return "";
        }
    }
}