<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviaEmail;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $professor = new Professor();
        $professores = Professor::All();
		return view("professor.index", [
			"professor" => $professor,
			"professores" => $professores
		]);
    }
	
    public function enviarEmailSenha($email, $senha)
    {
	Mail::to($email)->send(new EnviaEmail($senha));
	return 'Email enviado';
    }

    public function store(Request $request)
    {
	$enviarEmail = false;
        $request->validate([
			"nome" => "required",
			"email" => "required",
			"cpf" => "required"
		], [
			"nome.required" => "Nome é obrigatório",
			"email.required" => "Email obrigatório",
			"cpf.required" => "CPF obrigatório"
			
		]);
	if ($request->get("id") != 0)
	{
		$professor = Professor::Find($request->get("id"));
	}
	else
	{
		$professor = new Professor();
		$enviarEmail = true;
	}
	$professor->nome = $request->get("nome");
	$professor->email = $request->get("email");
	$professor->cpf = $request->get("cpf");
	$professor->save();
	if ($enviarEmail)
	{
		$senha = str_random(8);
		$this->enviarEmailSenha($professor->email, $senha);
	}
	$request->session()->flash("status", "Salvo com sucesso!");
	return redirect("/professor");
    }

    public function edit($id)
    {
        $professor = Professor::Find($id);
        $professores = Professor::All();
		return view("professor.index", [
			"professor" => $professor,
			"professores" => $professores
		]);
    }

    public function destroy(Request $request, $id)
    {
        Professor::Destroy($id);
		$request->session()->flash("status", "Deletado com sucesso!");
		return redirect ("/professor");
    }
}
