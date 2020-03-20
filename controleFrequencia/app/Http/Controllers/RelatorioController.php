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
			"turmas" => $turmas
		]);
    }

    public function store(Request $request)
    {
        //
    }

}
