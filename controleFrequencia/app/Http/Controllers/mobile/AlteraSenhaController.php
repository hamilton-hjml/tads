<?php

namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlteraSenhaController extends Controller
{
    public function index()
    {
		return view("mobile/privacidade");
	}
	
	public function store(Request $request)
    {
		$this->validate($request, [
			'senhaAntiga' => 'required',
			'senhaNova' => 'required'
			]);

		$idUsuario = Auth::id();
		$usuario = Auth::user();
		
		if (Hash::check($request->senhaAntiga, $usuario->password))
		{ 
			$usuario->fill(['password' => Hash::make($request->senhaNova)])->save();

			//return "senha alterada!";
			$request->session()->flash('success', 'Senha alterada!');
			return redirect()->route('privacidade.index');
		} 
		else 
		{
			
			//return "erro de alteração de senha!";
			$request->session()->flash('error', 'Senha atual incorreta!');
			return redirect()->route('privacidade.index');
		}
	}
}



