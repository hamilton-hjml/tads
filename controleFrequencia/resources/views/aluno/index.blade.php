@extends("layout.master")

@section("titulo", "Aluno")

@section("cadastro")
	
	<br>
	<h4 style="font-family:Gill Sans; color:#228B22;">Cadastro de alunos</h4>
	<br>
	<form method="POST" action="/aluno">
		@csrf
		<input type="hidden" name="id" value="{{ $aluno->id }}" />
		<div class="row">
			<div class="col-12 form-group">
				<label for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" value="{{ $aluno->nome }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('nome') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="matricula">Matrícula:</label>
				<input type="text" name="matricula" id="matricula" value="{{ $aluno->matricula }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('matricula') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="turma">Turma:</label>
				<select name="turma" id="turma" class="form-control">
					<option value=""></option>
					@foreach ($turmas as $turma)
					
						@if ($turma->id == $aluno->turma)
							<option value="{{ $turma->id }}" selected="selected">{{ $turma->nome }}</option>
						@else
							<option value="{{ $turma->id }}">{{ $turma->nome }}</option>
						@endif
						
					@endforeach
				</select>
				<small class="text-danger">{{ $errors->first('turma') }}</small>
			</div>
		
			<div class="col-4">
				<button class="btn btn-success botoes" type="submit">
					<i class="fa fa-save"></i>
					Salvar
				</button>
				<a class="btn btn-primary botoes" href="/turma">
					<i class="fa fa-plus"></i>
					Novo
				</a>
			</div>
		</div>
	</form>
	
	<hr/><hr/>
@stop

@section("listagem")
	<h4 style="font-family:Gill Sans; color:#228B22;">Listagem dos alunos</h4>
	<table class="table table-striped">
		<colgroup>
			<col width="400">
			<col width="400">
			<col width="400">
			<col width="200">
			<col width="200">
		</colgroup>	
		<thead>
			<tr>
				<th>Nome</th>
				<th>Matrícula</th>
				<th>Turma</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alunos as $aluno)
				<tr>
					<td>{{ $aluno->nome }}</td>
					<td>{{ $aluno->matricula }}</td>
					<td>{{ $aluno->turma }}</td>
					
					<td>
						<a href="/aluno/{{ $aluno->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<a href="/aluno/{{ $aluno->id }}/delete" class="btn btn-danger" onclick="return confirm('Confirma exclusão?');">
							<i class="fa fa-trash"></i>
							Excluir
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop