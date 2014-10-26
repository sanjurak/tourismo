<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>Manage Clock Travel</title>

	{{HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}
	<!--{{HTML::script('bootstrap/js/jquery.widget.min.js')}}-->
	{{HTML::script('bootstrap/js/jquery-2.1.0.min.js')}}
	
	{{HTML::script('bootstrap/js/metro.min.js')}}
	
	{{HTML::script('jquery-ui-1.10.4/ui/jquery-ui.js')}}
	{{HTML::style('jquery-ui-1.10.4/themes/base/jquery-ui.css')}}
	{{HTML::style('jquery-ui-1.10.4/themes/base/jquery.ui.datepicker.css')}}
	{{HTML::style('jquery-ui-1.10.4/themes/base/jquery.ui.theme.css')}}
	
	{{HTML::script('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js')}}
	<!--{{HTML::script('bootstrap/js/jquery.ui.widget.js')}}-->
	{{HTML::script('bootstrap/js/bootstrap.js')}}
	{{HTML::style('bootstrap/css/bootstrap.css')}}
	{{HTML::style('bootstrap/css/bootstrap-responsive.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap.css')}}
	{{HTML::style('bootstrap/css/metro-bootstrap-responsive.css')}}
	{{HTML::style('selectize/css/selectize.css')}}
	{{HTML::style('selectize/css/selectize.bootstrap2.css')}}
	{{HTML::style('bootstrap-editable/css/bootstrap-editable.css')}}
	{{HTML::script('selectize/js/standalone/selectize.js')}}

	{{HTML::script('bootstrap-editable/js/bootstrap-editable.min.js')}}
	{{HTML::script('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/js/bootstrap-editable.min.js')}}
	{{HTML::script('scripts/Site.js')}}
	{{HTML::script('scripts/functions.js')}}
	{{HTML::script('scripts/date.format.js')}}
	{{HTML::style('styles/Site.css')}}

	{{HTML::script('jquery-validator/js/jquery.validationEngine.js')}}
	{{HTML::script('jquery-validator/js/languages/jquery.validationEngine-srb.js')}}
	{{HTML::style('jquery-validator/css/validationEngine.jquery.css')}}

	<!--{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}-->
	<!--{{HTML::style('datepicker/css/datepicker.css')}}-->

	@yield("javascripts")
</head>
<body class="metro">
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
		                <li><a href="traveldeals">Aranžmani</a></li>
		                <li><a href="payments">Plaćanja</a></li>
		                <li><a href="reports">Izveštaji</a></li>
		                <li><a href="accommodation">Smeštaj</a></li>
		                <li><a href="organizators">Organizatori</a></li>
		            </ul>
		        </div>
		        <div id='logout' class="element place-right">
					@if (Auth::check())
						{{ Session::get('username') }}
						<a class="dropdown-toggle" href="logout">
		                	<span>logout</span>
		            	</a>
					@endif
				</div>
		       	<span class="element-divider place-right"></span>
		        <div id='exrate' class="element place-right">
					Kurs EUR na dan: {{ number_format(floatval(Session::get('exchRate')), 2) }} din
				</div>
		    </nav>
		</nav>
	</div>
    <div id="content"class="container metro">
       			 @yield('content')
     </div>

       <div id='footer' class="row">
       		<!-- <div style="background-image: url(images/clock_logo.png);background-repeat: no-repeat;margin-bottom:10px;width: 750px;height: 200px;"></div> -->
       		@yield('footer')
       </div>
    </body>
</html>