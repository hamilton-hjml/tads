<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration
{
    
    public function up()
    {
        Schema::create('professor', function (Blueprint $table) {
            $table->increments('id');
			$table->string("nome", 100);
			$table->string("email", 100);
			$table->string("cpf", 100);
            $table->timestamps();
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('professor');
    }
}
