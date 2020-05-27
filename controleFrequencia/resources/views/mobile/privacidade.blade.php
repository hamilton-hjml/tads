<!DOCTYPE html>

<html>
    <head>
		<title>Privacidade</title>
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
	</head>
    <body>
	
		<!-- Navegação -->
        <div class="topnav" id="myTopnav">
			<a href="menuPrincipal">Menu Principal</a>
			<a href="frequencia">Frequência</a>
			<a href="#" class="active">Privacidade</a>

			<a href="javascript:void(0);" class="icon" onclick="nav()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		
        <div id="telaLogin" class="page">
		<div class="painel-login">
			<h5>Alterar senha</h5>
			<br>
			<form method="POST" action="/mobile/privacidade">
			@csrf
				<input id="senhaAntiga" name="senhaAntiga" type="password" class="form-login" placeholder="Senha atual">
				<input id="senhaNova" name="senhaNova" type="password" class="form-login" placeholder="Nova senha">
				
				
				<div>
					<center>
						<button class="btn btn-success" type="submit">Alterar Senha</button>
					</center>
				</div>
			</form>
		</div>  
		
		
		<footer>
			<div class="rodape">
				<p>Controle de Frequência</p>
			</div>
		</footer>
		
        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>

