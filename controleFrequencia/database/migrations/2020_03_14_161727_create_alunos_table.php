<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->increments('id');
			$table->string("nome", 100);
			$table->string("matricula", 100);
			$table->integer("turma")->unsigned();
			$table->foreign("turma")->references("id")->on("turma");
            $table->timestamps();
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('aluno');
    }
}
