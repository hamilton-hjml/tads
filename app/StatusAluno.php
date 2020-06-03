<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAluno extends Model
{
    protected $table = "status_aluno";
    //protected $primaryKey = ['idChamada', 'idAluno'];
    protected $primaryKey = 'id';
}
