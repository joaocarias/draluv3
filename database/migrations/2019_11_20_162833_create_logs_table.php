<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{   
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tabela');
            $table->unsignedBigInteger('tabela_id');
            $table->string('acao', 30);
            $table->string('descricao');
            $table->bigInteger('usuario_id');
            $table->timestamps();
        });
    }
   
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
