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
	<div id='header'>
		@yield('header')
		<div id='logout' style="float:right">
			@if (Auth::check())
				{{ Session::get('username') }}
				{{ HTML::linkRoute('logout', 'sign out') }}
			@endif
		</div>
	</div>
    <div id="content">
        @yield('content')
       </div>

       <div id='footer'>
       		@yield('footer')
       </div>
    </body>
</html>