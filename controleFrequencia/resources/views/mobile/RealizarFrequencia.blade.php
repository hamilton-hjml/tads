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
			
				select.addEventListener('change', function()
				{
				window.location = '/mobile/frequencia?turma=' + this.value;
				}, false);
			
			}, false);
		</script>
	</head>
	
	<body>
		<!-- Navegação -->
        <div class="topnav" id="myTopnav">
			<a href="menuPrincipal.html">Menu Principal</a>
			<a href="frequencia.html">Frequência</a>
			<a href="privacidade.html">Privacidade</a>

			<a href="javascript:void(0);" class="icon" onclick="nav()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		
		<h5> Realizar Frequência</h5>
		
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
			
			<div id="data">
				<p><font size="2">Data:</font></p>
					
				<p></p><input type="date" id="data" name="data" value={{$data}} ></p>
			</div>
			

				@foreach ($alunos as $aluno)
				<p>{{ $aluno->nome }}
							<select name="alunos[{{$aluno->id}}]">							
								<option value="Presente">Presente</option>
								<option value="Ausente">Ausente</option>
								<option value="Atestado">Atestado</option>
							</select>
				</p>
				@endforeach
				
			<button class="btn btn-success botoes" type="submit">
				<i class="fa fa-save"></i>
				Salvar
			</button>

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
