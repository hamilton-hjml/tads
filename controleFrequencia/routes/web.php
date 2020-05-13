<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mobile/home', 'mobile\HomeController@index')->name('mobile/home');

Route::Resources([
	"professor"=>"ProfessorController",
	"turma"=>"TurmaController",
	"aluno"=>"AlunoController",
	"relatorio"=>"RelatorioController"
]);

Route::Get("/professor/{id}/delete", [
	"as" => "professor.destroy",
	"uses" => "ProfessorController@destroy"
	
]);

Route::Get("/turma/{id}/delete", [
	"as" => "turma.destroy",
	"uses" => "TurmaController@destroy"
	
]);

Route::Get("/aluno/{id}/delete", [
	"as" => "aluno.destroy",
	"uses" => "AlunoController@destroy"
	
]);
