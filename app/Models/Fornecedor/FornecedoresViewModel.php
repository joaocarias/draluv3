<?php 

namespace App\Models\Fornecedor;

class FornecedoresViewModel
{
    private $fornecedores;
     
    public function getFornecedores()
    {
        return $this->fornecedores;
    }

    public function setFornecedores($fornecedores)
    {
        $this->fornecedores = $fornecedores;
    }
}