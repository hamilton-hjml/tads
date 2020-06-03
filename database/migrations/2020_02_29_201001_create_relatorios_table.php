<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatoriosTable extends Migration
{
   
    public function up()
    {
        Schema::create('relatorio', function (Blueprint $table) {
            $table->increments('id');
			$table->integer("turma")->unsigned();
			$table->foreign("turma")->references("id")->on("turma");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relatorio');
    }
}
