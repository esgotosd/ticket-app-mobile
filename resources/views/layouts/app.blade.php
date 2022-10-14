<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Esgoto Pindureta - @yield('title')</title>
	
	<link rel="manifest" href="manifest.json">
	
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
	
    <!-- Icons -->
	<link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/icons/icons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/icons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="1024x1024" href="/icons/splash.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
	<meta name="theme-color" content="#000000">
</head>
<body class="d-flex flex-column h-100">
	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">@yield('title')</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarCollapse">
				
					<ul class="navbar-nav me-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="/">Registrar Pindura</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/mine" id="mine-link">Minhas Pinduras</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/general">Pinduras Gerais</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- Begin page content -->
	<main class="flex-shrink-0">
		<div class="container">
			@yield('content')
		</div>
	</main>
	
    <!-- Scripts -->
	<script>
	if ("serviceWorker" in navigator) 
	{
		window.addEventListener("load", function() 
		{
			navigator.serviceWorker
				.register("/serviceWorker.js")
				.then(res => console.log("service worker registered"))
				.catch(err => console.log("service worker not registered", err));
		});
	}
	</script>
	<script src="{{ asset('js/jquery-1.12.4.min.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/core.js') }}"></script>
	@yield('script')
</body>
</html>