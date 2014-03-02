@extends('home')

@section('content')

<div class="container">
<div class='row'>
	<div id='rezervacije' class="span4">
		{{HTML::linkRoute('reservations', 'Rezervacije')}}
		
	</div>
	<div id='putnici' class="span4">Putnici</div>
	<div id='destinacije' class="span4">Destinacije</div>
</div>
<div class="row">
	<div id='placanja' class="span4">Placanja</div>
	<div id='izvestaji' class="span4">Izvestaji</div>
	<div id='korisnici' class="span4">Korisnici</div>
</div>
</div>
@stop