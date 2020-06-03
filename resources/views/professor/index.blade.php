@extends("layout.master")

@section("titulo", "Professor")

@section("cadastro")
	
	<br>
	<h4 style="font-family:Gill Sans; color:#228B22;">Cadastro de professores</h4>
	<br>
	<form method="POST" action="/professor">
		@csrf
		<input type="hidden" name="id" value="{{ $professor->id }}" />
		<div class="row">
			<div class="col-12 form-group">
				<label for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" value="{{ $professor->nome }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('nome') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" value="{{ $professor->email }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('email') }}</small>
			</div>
			
			<div class="col-4 form-group">
				<label for="cpf">CPF:</label>
				<input type="text" name="cpf" id="cpf" value="{{ $professor->cpf }}" class="form-control" />
				<small class="text-danger">{{ $errors->first('cpf') }}</small>
			</div>
		
			<div class="col-4">
				<button class="btn btn-success botoes" type="submit">
					<i class="fa fa-save"></i>
					Salvar
				</button>
				<a class="btn btn-primary botoes" href="/professor">
					<i class="fa fa-plus"></i>
					Novo
				</a>
			</div>
		</div>
	</form>
	<hr/><hr/>
@stop

@section("listagem")
	<h4 style="font-family:Gill Sans; color:#228B22;">Listagem dos professores</h4>
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
				<th>Email</th>
				<th>CPF</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($professores as $professor)
				<tr>
					<td>{{ $professor->nome }}</td>
					<td>{{ $professor->email }}</td>
					<td>{{ $professor->cpf }}</td>
					<td>
						<a href="/professor/{{ $professor->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<a href="/professor/{{ $professor->id }}/delete" class="btn btn-danger" onclick="return confirm('Confirma exclusão?');">
							<i class="fa fa-trash"></i>
							Excluir
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop