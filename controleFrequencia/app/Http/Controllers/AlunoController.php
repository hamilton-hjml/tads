<?php

namespace App\Http\Controllers;
use App\Aluno;
use App\Turma;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AlunoController extends Controller
{
  
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function listaAlunos() {
		$alunos = DB::table('aluno AS a')
						->join('turma AS t', 'a.turma', '=', 't.id')
						->select('a.id', 'a.nome', 'a.matricula', 't.nome AS turma')
						->get();
		return $alunos;
	}
	
    public function index()
    {
        $aluno = new Aluno();
		$alunos = $this->listaAlunos();
        $turmas = Turma::All();
		return view("aluno.index", [
			"aluno" => $aluno,
			"alunos" => $alunos,
			"turmas" => $turmas
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
			"nome" => "required",
			"matricula" => "required",
			"turma" => "required",
			
		], [
			"nome.required" => "Nome obrigatório", 
			"matricula.required" => "Matricula obrigatório",
			"turma.required" => "Turma obrigatório"
			
		]);
		
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
		return redirect("/aluno");
    }
	
    public function edit($id)
    {
        $aluno = Aluno::Find($id);
		$alunos = $this->listaAlunos();
        $turmas = Turma::All();
		return view("aluno.index", [
			"aluno" => $aluno,
			"alunos" => $alunos,
			"turmas" => $turmas
		]);
    }

    public function destroy(Request $request, $id)
    {
        Aluno::Destroy($id);
		$request->session()->flash("status", "Deletado com sucesso!");
		return redirect ("/aluno");
    }
}
