@extends('home')
@section('content')

{{HTML::script('scripts/reservations.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Lista putnika za period</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
<br>
<div class="container" id="reservations">
<div class="row">

	<div class="row">
		<div id="reservationsPartial">
			
		</div>
	</div>
</div>

@stop