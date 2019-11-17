<?php 

namespace App\Models\Paciente;

class PacientesViewModel
{
    private $pacientesRecentes;
    private $filtro;
    private $pacientesFiltro;

    public function getPacientesRecentes(){
        return $this->pacientesRecentes;
    }

    public function setPacientesRecentes($value){
        $this->pacientesRecentes = $value;
    }

    public function getFiltro(){
        return $this->filtro;
    }

    public function setFiltro($value){
        $this->filtro = $value;
    }

    public function getPacientesFiltro(){
        return $this->pacientesFiltro;
    }

    public function setPacientesFiltro($value){
        $this->pacientesFiltro = $value;
    }
}