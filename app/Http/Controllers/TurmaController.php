<?php

namespace App\Http\Controllers;
use App\Turma;
use App\Professor;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TurmaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function listaTurmas() {
		$turmas = DB::table('turma AS t')
						->join('professor AS p', 't.professor', '=', 'p.id')
						->select('t.id', 't.nome', 't.semestre', 't.ano', 'p.nome AS professor')
						->get();
		return $turmas;
	}
    
    public function index()
    {
        $turma = new Turma();
		$turmas = $this->listaTurmas();
        $professores = Professor::All();
		return view("turma.index", [
			"turma" => $turma,
			"turmas" => $turmas,
			"professores" => $professores
		]);
    }

    public function store(Request $request)
    {
        $request->validate([
			"nome" => "required",
			"semestre" => "required",
			"ano" => "required",
			"professor" => "required",
			
		], [
			"nome.required" => "Nome obrigatório", 
			"semestre.required" => "Semestre obrigatório",
			"ano.required" => "Ano obrigatório",
			"professor.required" => "Professor obrigatório"
			
		]);
		
		if ($request->get("id") != 0){
			$turma = Turma::Find($request->get("id"));
		}else{
		$turma = new Turma();
		}
		$turma->nome = $request->get("nome");
		$turma->semestre = $request->get("semestre");
		$turma->ano = $request->get("ano");
		$turma->professor = $request->get("professor");
		
		$turma->save();
		$request->session()->flash("status", "Salvo com sucesso!");
		return redirect("/turma");
    }

    public function edit($id)
    {
        $turma = Turma::Find($id);
		$turmas = $this->listaTurmas();
        $professores = Professor::All();
		return view("turma.index", [
			"turma" => $turma,
			"turmas" => $turmas,
			"professores" => $professores
		]);
    }

    public function destroy(Request $request, $id)
    {
        Turma::Destroy($id);
		$request->session()->flash("status", "Deletado com sucesso!");
		return redirect ("/turma");
    }
}
