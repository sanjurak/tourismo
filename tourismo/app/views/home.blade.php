<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tourismo</title>
	{{HTML::style('bootstrap/css/bootstrap.css')}}
	{{HTML::style('bootstrap/css/bootstrap-responsive.css')}}
	{{HTML::script('bootstrap/js/bootstrap.js')}}
	
</head>
<body>
	<div id='header' class="row">
		@yield('header')
		<div id='logout' class="label label-default pull-right">
			@if (Auth::check())
				{{ Session::get('username') }}
				{{ HTML::linkRoute('logout', 'sign out') }}
			@endif
		</div>
	</div>
    <div id="content" class="row">
        @yield('content')
       </div>

       <div id='footer' class="row">
       		@yield('footer')
       </div>
    </body>
</html>