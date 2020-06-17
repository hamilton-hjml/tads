	@extends("layout.master")

@section("titulo", "Relatorio")

@section("cadastro")
	
	<br>
	<h4 style="font-family:Gill Sans; color:#228B22;">Relatório de frequência</h4>
	<br>
	<form method="POST" action="/relatorio">
		@csrf
		<input type="hidden" name="id" value="{{ $relatorio->id }}" />
		<div class="row">
			<div class="col-8 form-group">
				<label for="turma">Turma:</label>
				<select name="turma" id="turma" class="form-control">
					<option value=""></option>
					@foreach ($turmas as $turma)
					
						@if ($turma->id == $relatorio->turma)
							<option value="{{ $turma->id }}" selected="selected">{{ $turma->nome }}</option>
						@else
							<option value="{{ $turma->id }}">{{ $turma->nome }}</option>
						@endif
						
					@endforeach
				</select>
				<small class="text-danger">{{ $errors->first('relatorio') }}</small>
			</div>
		
			<div class="col-4">
				<button class="btn btn-warning botoes" type="submit">
					<i class="fa fa-search"></i>
					Buscar
				</button>
				
			</div>
		</div>
	</form>
	<hr/><hr/>
@stop

@section("listagem")
	<h4 style="font-family:Gill Sans; color:#228B22;">Listagem de frequências</h4>
	
	<div style="overflow:auto">
	<table style="white-space:nowrap;" class="table table-striped">
		<colgroup>
			<col width="400">
			<col width="400">
			<col width="400">
			<col width="400">
		</colgroup>	
		<thead>
			<tr>
				<th>Aluno</th>
				@foreach ($datas as $data)
						
						<th style="padding-bottom: 12px;padding-top: 0.0px;padding-right: 0px;padding-left: 0px;"><input type="date" value="{{$data}}" readonly required="required"></th>
						
						
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach ($alunos as $nome => $statuses)
				<tr>
					<td>{{ $nome}}</td>
					@foreach ($statuses as $status)
					<td>{{ $status}}</td>
					@endforeach
				</tr>
			@endforeach
			<!--
			@foreach ($relatorios as $relatorio)
				<tr>
					<td>{{ $relatorio->turma }}</td>
					<td>{{ $relatorio->turma }}</td>
					<td>{{ $relatorio->turma }}</td>
					<td>{{ $relatorio->turma }}</td>
					<td>
						<a href="/relatorio/{{ $relatorio->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<a href="/relatorio/{{ $relatorio->id }}/delete" class="btn btn-danger" onclick="return confirm('Confirma exclusão?');">
							<i class="fa fa-trash"></i>
							Excluir
						</a>
					</td>
				</tr>
			@endforeach
			-->
		</tbody>
	</table>
	</div>
@stop