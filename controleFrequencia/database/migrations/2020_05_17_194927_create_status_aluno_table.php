<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusAlunoTable extends Migration
{
	public function up()
    {
        Schema::create('status_aluno', function (Blueprint $table) {		
			$table->integer("idChamada")->unsigned();	
			$table->foreign("idChamada")->references("idChamada")->on("chamada");
			
			$table->integer("idAluno")->unsigned();	
			$table->foreign("idAluno")->references("id")->on("aluno");
			
			$table->string("statusAluno", 15);
            $table->timestamps();
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('status_aluno');
    }
}
