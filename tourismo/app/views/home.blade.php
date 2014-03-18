<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tourismo</title>
	{{HTML::style('bootstrap/css/bootstrap.css')}}
	{{HTML::style('bootstrap/css/bootstrap-responsive.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap-responsive.css')}}
	{{HTML::script('bootstrap/js/bootstrap.js')}}
	{{HTML::script('bootstrap/js/jquery-2.1.0.min.js')}}
	{{HTML::script('bootstrap/js/jquery.widget.min.js')}}
	{{HTML::script('bootstrap/js/jquery-ui.js')}}
	{{HTML::script('bootstrap/js/jquery.ui.widget.js')}}
	{{HTML::script('bootstrap/js/metro-loader.js')}}
</head>
<body>
	<div id='header' class="metro">
		@yield('header')
		<nav class="navigation-bar dark">
		    <nav class="navigation-bar-content">
				<div class="element">
		            <a class="dropdown-toggle" href="#">
		                <span>MENU</span>
		            </a>
		            <ul class="dropdown-menu" data-role="dropdown">
		                <li><a href="reservations">Rezervacije</a></li>
		                <li><a href="passangers">Putnici</a></li>
		                <li><a href="destinations">Destinacije</a></li>
		                <li><a href="arangements">Aranžmani</a></li>
		                <li><a href="payments">Plaćanja</a></li>
		                <li><a href="reports">Izveštaji</a></li>
		            </ul>
		        </div>
		        <span class="element-divider place-right"></span>
		        <div id='logout' class="element place-right">
					@if (Auth::check())
						{{ Session::get('username') }}
						<a class="dropdown-toggle" href="logout">
		                	<span>logout</span>
		            	</a>
					@endif
				</div>
		    </nav>
		</nav>
	</div>
    <div id="content" class="metro">
        @yield('content')
       </div>

       <div id='footer' class="row">
       		@yield('footer')
       </div>
    </body>
</html>