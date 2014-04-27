<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tourismo</title>
	{{HTML::style('bootstrap/css/bootstrap.css')}}
	{{HTML::style('bootstrap/css/bootstrap-responsive.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap-responsive.css')}}
	{{HTML::script('bootstrap/js/jquery-2.1.0.min.js')}}
	{{HTML::script('bootstrap/js/jquery-ui.js')}}
	{{HTML::script('bootstrap/js/bootstrap.js')}}
	{{HTML::script('bootstrap/js/jquery.widget.min.js')}}
	{{HTML::script('bootstrap/js/jquery.ui.widget.js')}}
	{{HTML::script('bootstrap/js/metro-loader.js')}}
	{{HTML::script('scripts/Site.js')}}

	{{HTML::script('jquery-validator/js/jquery.validationEngine.js')}}
	{{HTML::script('jquery-validator/js/languages/jquery.validationEngine-srb.js')}}
	{{HTML::style('jquery-validator/css/validationEngine.jquery.css')}}

	{{HTML::style('styles/Site.css')}}
</head>
<body class="metro">
	<div id='header'>
		@if (Auth::check())
			{{ HTML::linkRoute('logout', 'sign out') }}
		@endif
	</div class="container">
        @yield('content')
    </body>
</html>