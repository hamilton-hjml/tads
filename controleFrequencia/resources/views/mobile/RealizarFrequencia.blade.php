<!DOCTYPE html>
<html>
	<head>
		<title>Realizar frequência</title>
		<meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/fa/css/all.css" />
		<link rel="stylesheet" href="css/interface.css" />
		<script src="js/jquery-3.3.1.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/script.js"></script>
		<script src="js/Menu/javascript.js"></script>
		
		<script>
			window.addEventListener('load', function()
			{
			var select = document.getElementById('turma_select');
			var data = document.getElementById('data');
			var func = function(){
									window.location = '/mobile/frequencia?turma=' + select.value + "&data=" + data.value;
								}
			select.addEventListener('change', func, false);
			data.addEventListener('change', func, false);
			
			}, false);
		</script>
	</head>
	
	<body>
		<!-- Navegação -->
        <div class="topnav" id="myTopnav">
			<a href="menuPrincipal">Menu Principal</a>
			<a href="frequencia">Frequência</a>
			<a href="privacidade">Privacidade</a>

			<a href="javascript:void(0);" class="icon" onclick="nav()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		
		<h5> 
			@if ($existe)
				Alterar Frequência
			@else
				Realizar Frequência
			@endif
		</h5>
		
		<br>
		
		<form method="POST" action="/mobile/frequencia">
			@csrf
			
			
			<div id="turma">
				<p><font size="2">Turma:</font></p>
					<select name="turma" id="turma_select">
						@foreach ($turmas as $turma)
							@if ($turma->id == $idTurma)
								<option value="{{ $turma->id }}" selected="selected">{{ $turma->nome }}</option>
							@else
								<option value="{{ $turma->id }}">{{ $turma->nome }}</option>
							@endif			
						@endforeach
					</select>
			</div>
			
			<div id="div_data">
				<p><font size="2">Data:</font></p>
					
				<p></p><input type="date" id="data" name="data" value={{$data}} ></p>
			</div>
			
				
			<div id = "alunos">
				@foreach ($alunos as $aluno)
				<p>{{ $aluno->nome }}
							<select name="alunos[{{$aluno->id}}]" class="status_select">		
								@if (!empty($aluno->statusAluno))
									@if ($aluno->statusAluno == "Presente")
										<option value="Presente" selected="selected" >Presente</option>
									@else
										<option value="Presente">Presente</option>
									@endif	
										
									@if ($aluno->statusAluno == "Ausente")
										<option value="Ausente" selected="selected">Ausente</option>
									@else
										<option value="Ausente">Ausente</option>
									@endif
									
									@if ($aluno->statusAluno == "Atestado")
										<option value="Atestado" selected="selected">Atestado</option>
									@else
										<option value="Atestado">Atestado</option>
									@endif
								@else										
								<option value="Presente">Presente</option>
								<option value="Ausente">Ausente</option>
								<option value="Atestado">Atestado</option>
								@endif
							</select>
							
				</p>
				@endforeach
			
			
			
				
			<button class="btn btn-success botoes" type="submit">
				<i class="fa fa-save"></i>
				Salvar
			</button>
			@if ($existe)
				
				<a href="/mobile/apagarfrequencia?turma={{$idTurma}}&data={{$data}}" class="btn btn-danger botoes botao_direita">
					<i class="fa fa-trash"></i>
					Excluir
				</a>
			@endif
			
			</div>
		</form>
	
		<footer>
			<div class="rodape">
				<p>Controle de Frequência</p>
			</div>
		</footer>
		
        <script type="text/javascript" src="js/index.js"></script>
    </body>
	</body>
</html>
