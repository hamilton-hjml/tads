<?php

namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Turma;
use App\Chamada;
use App\StatusAluno;
use App\Aluno;

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
		date_default_timezone_set('UTC');
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

        $data = now();
        if($request->data)
        {
			$data = $request->data;
		}
        
        //checando se a turma atual já tem uma chamada realizada na data selecionada
        //TODO: ENVIAR O ID DA TURMA E ALTERAR NO VIEW(DEPOIS DO STORE)
        $chamadaExiste = DB::table("chamada")
        ->where("chamada.idTurma", "=", $idTurma)
        ->whereDate('data',$data)
        ->get();
        
        //dd("fwut",$idTurma, $data, $chamadaExiste);
        //dd($chamadaExiste);
        $existe = false;
        if(count($chamadaExiste) == 1)
        {
			//caso a chamada exista, obtenha o statusAluno de todos os alunos da chamada atual, juntamente com a tabela aluno
			$alunos = DB::table("status_aluno")
			->where("status_aluno.idChamada", "=", $chamadaExiste[0]->idChamada)
			->join("aluno", "aluno.id", "=", "status_aluno.idAluno")
			->get();
			
			$existe = true;
		}
		else if(count($chamadaExiste) > 1)
		{
			die("erro! mais de 1 chamada por data!");
		}
        
				
		return view("mobile/RealizarFrequencia",[
			"idTurma" => $idTurma,
			"alunos" => $alunos,
			"data" => $data,
			"turmas" => $turmas,
			"existe" => $existe
		]);
    }
    
    public function store(Request $request)
    {
		date_default_timezone_set('UTC');
		$data = $request->get("data");
		$turma = $request->get("turma");
		$alunos = $request->get("alunos");
		
		
		//primeiro, salvar a chamda...
		//somente se a chamada não existe
		
		//checando se a turma atual já tem uma chamada realizada na data selecionada
        $chamadaExiste = DB::table("chamada")
        ->where("chamada.idTurma", "=", $turma)
        ->whereDate('data',$data)
        ->get();
        
        //dd("fwut",$idTurma, $data, $chamadaExiste);
        //dd($chamadaExiste);
        $chamada = false;
        $existe = false;
        if(count($chamadaExiste) == 1)
        {
			$chamada = $chamadaExiste[0];
			$existe = true;
		}
		else
		{
			$chamada = new Chamada();
		
			$chamada->idTurma = $turma;
			$chamada->data = $data;
			$chamada->save();
			//dd($chamada);
		}
		$idChamada = $chamada->idChamada;
		
		//depois, pega cada aluno que faz parte da chamada e armazena seu status com id do aluno e id da chamada
		
		foreach ($alunos as $idAluno => $status)
		{
			//se a chamada existe, apenas update
			if(count($chamadaExiste) == 1)
			{
				//$statusAluno = DB::table("status_aluno")
				//->where("status_aluno.idChamada", "=", $idChamada)
				//->where("status_aluno.idAluno",$idAluno)
				//->get()[0];
				//$statusAluno->statusAluno = $status;
				
				//$statusAluno.update();
				DB::table('status_aluno')
				->where("status_aluno.idChamada", "=", $idChamada)
				->where("status_aluno.idAluno",$idAluno)
				->update(['statusAluno' => $status]);
			}
			else
			{
				$statusAluno = new StatusAluno();
				//dd($statusAluno);
				$statusAluno->idChamada = $idChamada;
				$statusAluno->idAluno = $idAluno;
				$statusAluno->statusAluno = $status;
				$statusAluno->save();
			}
		}
		
		//return redirect("/mobile/frequencia");
		return redirect()->route('frequencia.index',["turma" => $turma, "data" => $data]);
    }
    
    public function destroy(Request $request)
    {
		$data = $request->get("data");
		$turma = $request->get("turma");
		
		 //checando se a turma atual já tem uma chamada realizada na data selecionada
        $chamadaExiste = DB::table("chamada")
        ->where("chamada.idTurma", "=", $turma)
        ->whereDate('data',$data)
        ->get();

        if(count($chamadaExiste) == 1)
        {
			$idChamada = $chamadaExiste[0]->idChamada;
			//caso a chamada exista, obtenha o statusAluno de todos os alunos da chamada atual, juntamente com a tabela aluno
			$alunos = DB::table("status_aluno")
			->where("status_aluno.idChamada", "=", $idChamada)
			->join("aluno", "aluno.id", "=", "status_aluno.idAluno")
			->get();
			
			//apague os status aluno			
			//$statusAluno.update();
			DB::table('status_aluno')
			->where("status_aluno.idChamada", "=", $idChamada)
			->delete();
			
			//após, apague a chamada
			DB::table("chamada")
				->where("chamada.idChamada", "=", $idChamada)
				->delete();
		}
		
		return redirect()->route('frequencia.index',["turma" => $turma, "data" => $data]);
    }
}
