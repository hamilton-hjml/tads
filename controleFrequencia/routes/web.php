<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/mobile/home', 'mobile\HomeController@index')->name('mobile/home');
Route::get('/mobile/login', 'mobile\MobileLoginController@index')->name('mobile/login');
Route::get('/mobile/MenuPrincipal', 'mobile\MenuPrincipalController@index')->name('mobile/MenuPrincipal');


/*
Route::Resources([
	"professor"=>"ProfessorController",
	"turma"=>"TurmaController",
	"aluno"=>"AlunoController",
	"relatorio"=>"RelatorioController"
]);
*/

Route::group(['middleware' => 'role:admin'], function() {
        Route::resource('professor', 'ProfessorController');
        Route::resource('turma', 'TurmaController');
        Route::resource('aluno', 'AlunoController');
        Route::resource('relatorio', 'RelatorioController');
    });
    
Route::group(['middleware' => 'role:professor'], function() {
         
    Route::Get("/mobile/frequencia?turma={idTurma}", [
	"as" => "frequencia.index",
	"uses" => "mobile\FrequenciaController@index"]);
	
	Route::resource('mobile/frequencia', 'mobile\FrequenciaController');
	
	Route::Get("/mobile/frequencia", [
	"as" => "frequencia.index",
	"uses" => "mobile\FrequenciaController@index"]);
	
	
    });

Route::Get("/professor/{id}/delete", [
	"as" => "professor.destroy",
	"uses" => "ProfessorController@destroy"
	
])->middleware('role:admin');

Route::Get("/turma/{id}/delete", [
	"as" => "turma.destroy",
	"uses" => "TurmaController@destroy"
	
])->middleware('role:admin');

Route::Get("/aluno/{id}/delete", [
	"as" => "aluno.destroy",
	"uses" => "AlunoController@destroy"
	
])->middleware('role:admin');
