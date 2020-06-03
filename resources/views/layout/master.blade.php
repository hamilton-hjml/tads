<!DOCTYPE html>
<html>
	<head>
		<title>@yield("titulo")</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/fa/css/all.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/multiple-select.css') }}" />
		
		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/jquery.mask.js') }}"></script>
		<script src="{{ asset('js/bootstrap.js') }}"></script>
		<script src="{{ asset('js/script.js') }}"></script>
		<script src="{{ asset('js/multiple-select.js') }}"></script>	
	</head>
	<body>
		<nav class="navbar navbar-expand-sm" style="background-color: #3CB371;">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/professor"  style="color:#ffffff;">Professor</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/turma"  style="color:#ffffff;">Turma</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/aluno"  style="color:#ffffff;">Aluno</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/relatorio"  style="color:#ffffff;">Relatório</a>
				</li>
			</ul>
			
			<ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
		</nav>
		
		@if (Session::has("status"))
			<div class="alert alert-success">
				{{ Session::get("status") }}
			</div>
		@endif
		<div class="container">
			<div id="cadastro">
				@yield("cadastro")
			</div>
			<div id="listagem">
				@yield("listagem")
			</div>
		</div>
	</body>
</html>