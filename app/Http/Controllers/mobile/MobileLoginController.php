<?php

namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class MobileLoginController extends Controller
{
    public function index()
    {
		return view("mobile/login");
	}
	
	public function store(Request $request)
    {
		
		//obtendo email a partir do cpf
		$email = DB::table("professor")
			->where("professor.cpf", "=", $request->cpf)
			->join("users", "users.id", "=", "professor.id")
			->get()[0]->email;
		
		$credentials = ['email' => $email, 'password' => $request->senha];

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('mobile/menuPrincipal');
        }
	}
}



