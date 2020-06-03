@extends("layout.master")

@section("titulo", "Turma")

@section("cadastro")
	
	<br>
	<h4 style="font-family:Gill Sans; color:#228B22;">Cadastro de turmas</h4>
	<br>
	<form method="POST" action="/turma">
		@csrf
		<input type="hidden" name="id" value="{{ $turma->id }}" />
		<div class="row">
			<div class="col-6 form-group">
				<label for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" value="{{ $turma->nome }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('nome') }}</small>
			</div>
			
			<div class="col-6 form-group">
				<label for="semestre">Semestre:</label>
				<input type="text" name="semestre" id="semestre" value="{{ $turma->semestre }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('semestre') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="ano">Ano:</label>
				<input type="text" name="ano" id="ano" value="{{ $turma->ano }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('ano') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="professor">Professor:</label>
				<select name="professor" id="professor" class="form-control">
					<option value=""></option>
					@foreach ($professores as $professor)
					
						@if ($professor->id == $turma->professor)
							<option value="{{ $professor->id }}" selected="selected">{{ $professor->nome }}</option>
						@else
							<option value="{{ $professor->id }}">{{ $professor->nome }}</option>
						@endif
						
					@endforeach
				</select>
				<small class="text-danger">{{ $errors->first('professor') }}</small>
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
	<h4 style="font-family:Gill Sans; color:#228B22;">Listagem dos turmas</h4>
	<table class="table table-striped">
		<colgroup>
			<col width="400">
			<col width="400">
			<col width="400">
			<col width="400">
			<col width="200">
			<col width="200">
		</colgroup>	
		<thead>
			<tr>
				<th>Nome</th>
				<th>Semestre</th>
				<th>Ano</th>
				<th>Professor</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($turmas as $turma)
				<tr>
					<td>{{ $turma->nome }}</td>
					<td>{{ $turma->semestre }}</td>
					<td>{{ $turma->ano }}</td>
					<td>{{ $turma->professor }}</td>
					<td>
						<a href="/turma/{{ $turma->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<a href="/turma/{{ $turma->id }}/delete" class="btn btn-danger" onclick="return confirm('Confirma exclusão?');">
							<i class="fa fa-trash"></i>
							Excluir
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop