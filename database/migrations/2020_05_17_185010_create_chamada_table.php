<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamadaTable extends Migration
{
	public function up()
    {
        Schema::create('chamada', function (Blueprint $table) {
            $table->increments('idChamada');
            
            $table->integer("idTurma")->unsigned();
            $table->foreign("idTurma")->references("id")->on("turma");
            
            $table->date("data");
            $table->timestamps();
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('chamada');
    }
}
