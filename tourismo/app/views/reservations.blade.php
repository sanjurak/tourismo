@extends('home')


@section('content')


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