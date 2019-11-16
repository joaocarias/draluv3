<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{   
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('cpf', 14)->nullable();
            $table->string('nome', 255);
            $table->char('genero');
            $table->date('data_de_nascimento');
            $table->string('email', 255)->nullable();
            $table->string('telefone', 30)->nullable();
            $table->bigInteger('ficha_id')->nullable();
            $table->string('observacao', 1000)->nullable();
            
            $table->unsignedBigInteger('usuario_cadastro');
            $table->foreign('usuario_cadastro')->references('id')->on('users');
            
            $table->unsignedBigInteger('endereco_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos'); 

            $table->softDeletes();
            $table->timestamps();
            
        });
    }
   
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
