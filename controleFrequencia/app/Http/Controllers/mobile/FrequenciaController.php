<?php

namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Turma;
use App\Chamada;
use App\StatusAluno;

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
		
		$data = $request->get("data");
		$turma = $request->get("turma");
		$alunos = $request->get("alunos");
		
		
		//primeiro, salvar a chamda...
		$chamada = new Chamada();
		
		$chamada->idTurma = $turma;
		$chamada->data = $data;
		$chamada->save();
		$idChamada = $chamada->id;
		
		//depois, pega cada aluno que faz parte da chamada e armazena seu status com id do aluno e id da chamada
		foreach ($alunos as $idAluno => $status) 
		{
			$statusAluno = new StatusAluno();
			
			$statusAluno->idChamada = $idChamada;
			$statusAluno->idAluno = $idAluno;
			$statusAluno->statusAluno = $status;
			$statusAluno->save();
		}
		
		return redirect("/mobile/frequencia");
    }
}
