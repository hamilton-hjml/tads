<?php

namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Turma;

use Illuminate\Support\Facades\DB;

class FrequenciaController extends Controller
{
	public function listaTurmaAlunos($idTurma) {
		$alunos = DB::table('aluno AS a')
						->join('turma AS t', 'a.turma', '=', 't.id')
						->select('a.id', 'a.nome', 'a.matricula', 't.nome AS turma')
						->where('t.id', '=', $idTurma)
						->get();
		return $alunos;
	}
	
    public function index(Request $request)
    {
		$idTurma = 0;
		if($request->turma)
		{
			$idTurma = $request->turma;
		}
        $turmas = Turma::All();
        if($turmas->count() > 0)
        {
			if($idTurma == 0)
			{
				$idTurma = $turmas[0]->id;
			}
        }
        
        $alunos = $this->listaTurmaAlunos($idTurma);

        $data = now(); //TODO: AJUSTAR DE ACORDO COM ID
        //TODO: SE DATA ATUAL JÁ TEM UM RECORD, FAZER O HANDLING DESSE ERRO
        
		return view("mobile/RealizarFrequencia",[
			"idTurma" => $idTurma,
			"alunos" => $alunos,
			"data" => $data,
			"turmas" => $turmas
		]);
    }
    
    public function store(Request $request)
    {
		dd($request);
		/*
        $request->validate([
			"nome" => "required",
			"matricula" => "required",
			"turma" => "required",
			
		], [
			"nome.required" => "Nome obrigatório", 
			"matricula.required" => "Matricula obrigatório",
			"turma.required" => "Turma obrigatório"
			
		]);
		*/
		
		$data = $request->get("data");
		$idTurma = $request->get("idTurma");
		$data = $request->get("data");
		
		/*
		
		if ($request->get("id") != 0){
			$aluno = Aluno::Find($request->get("id"));
		}else{
		$aluno = new Aluno();
		}
		$aluno->nome = $request->get("nome");
		$aluno->matricula = $request->get("matricula");
		$aluno->turma = $request->get("turma");
		
		$aluno->save();
		$request->session()->flash("status", "Salvo com sucesso!");
		
		*/
		return redirect("/mobile/frequencia");
    }
}
