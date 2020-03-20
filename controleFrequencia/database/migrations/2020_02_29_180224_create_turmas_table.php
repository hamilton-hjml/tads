<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    
    public function up()
    {
        Schema::create('turma', function (Blueprint $table) {
            $table->increments('id');
			$table->string("nome", 100);
			$table->string("semestre", 100);
			$table->string("ano", 100);
			$table->integer("professor")->unsigned();
			$table->foreign("professor")->references("id")->on("professor");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turma');
    }
}
