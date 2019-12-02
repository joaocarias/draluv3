<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nome_social', 255);
            $table->string('cpf_cnpj', 25)->nullable();
            $table->string('inscricao', 30)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('telefone', 30)->nullable();            
            $table->string('observacao', 1000)->nullable();
                        
            $table->unsignedBigInteger('usuario_cadastro');
            $table->foreign('usuario_cadastro')->references('id')->on('users');
            
            $table->unsignedBigInteger('endereco_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos'); 

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedors');
    }
}
