@extends('home')

@section('content')
<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Rezervacije</a></li>
	    </ul>
	</nav>
</div>

<div class="container" id="reservations">
	<div class="row">
		<a class="btn btn-default pull-right" href="#" id="newReservation">Nova rezervacija</a>
	</div>

	<div class="row">
		<div id="reservationsPartial">
			{{$reservationsPartial}}
		</div>
	</div>
</div>
@stop