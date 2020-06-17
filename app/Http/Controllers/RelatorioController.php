<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relatorio;
use App\Turma;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
	public function listaRelatorios() {
		$relatorios = DB::table('relatorio AS r')
						->join('turma AS t', 'r.turma', '=', 't.id')
						->select('r.id', 'r.turma AS turma')
						->get();
		return $relatorios;
	}
	
	public function index()
	{
		$relatorio = new Relatorio();
		$relatorios = $this->listaRelatorios();
		$turmas = Turma::All();
		return view("relatorio.index", [
			"relatorio" => $relatorio,
			"relatorios" => $relatorios,
			"turmas" => $turmas,
			"datas" => [],
			"alunos" => []
		]);
	}

	public function store(Request $request)
	{
		$idTurma = $request->turma;
		$frequencias = DB::select(DB::raw('
		select aluno.nome, chamada.data, status_aluno."statusAluno" from 
		  aluno, chamada, status_aluno 
		where 
		  chamada."idChamada" = status_aluno."idChamada" 
		and 
		  aluno.id = status_aluno."idAluno"
		and
		  aluno.turma = :idTurma
		group by
		  aluno.nome, chamada.data, status_aluno."statusAluno"
		;'), ['idTurma' => $idTurma]);
		
		$datas = array_unique(array_column($frequencias, "data"));
	
		//os dados otidos da tabela devem estar agrupados
		$agrupados = [];
		$prev = null;
		foreach($frequencias as $linha)
		{
			if($linha->nome != $prev)
			{ 
				//primeiro elemento
				$agrupados[$linha->nome] = [$linha->statusAluno];
			}
			else
			{
				//agrupar junto ao último
				$agrupados[$linha->nome][] = $linha->statusAluno;
			}
			$prev = $linha->nome;
		}
		
		
		$relatorio = new Relatorio();
		$relatorio->turma = $idTurma;
		$relatorios = $this->listaRelatorios();
		$turmas = Turma::All();
		return view("relatorio.index", [
			"relatorio" => $relatorio,
			"relatorios" => $relatorios,
			"turmas" => $turmas,
			"alunos" => $agrupados,
			"datas" => $datas,
		]);
	}
}
