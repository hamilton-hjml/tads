<!DOCTYPE html>

<html>
    <head>
		<title>Tela de Login</title>
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
	
		<div class="topnav" id="myTopnav">	
		<h5>SGF<h5>		
		
			<a href="javascript:void(0);" class="icon" onclick="nav()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		
        <div id="telaLogin" class="page">
		<div class="painel-login">
			<div class="login-header">
				<img src="img/logoSGF.png" height=130px;>
			</div>
			<br>
			<input type="text" class="form-login" placeholder="CPF">
			<input type="password" class="form-login" placeholder="Senha">
			<div>
				<button class="btn btn-success" type="submit" onclick="window.location.href = 'MenuPrincipal.html'";>Entrar</button>
				<button class="btn btn-primary">Esqueci minha senha</button>
			</div>
		</div>  
		
		
		<footer>
			<div class="rodape">
				<p>Controle de Frequência</p>
			</div>
		</footer>
	
        <script type="text/javascript" src="mobileapp/js/index.js"></script>
    </body>
</html>

