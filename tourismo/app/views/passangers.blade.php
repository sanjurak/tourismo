@extends('layout')
@section('content')
<h1>Putnici</h1>
<?php $passangers = Passanger::paginate(10); ?>
{{ $passangers->links() }}
<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Adresa</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><div class="input-control text">
	    		<input type="text" value="" placeholder="Ime"/>
			</div></td>
			<td><div class="input-control text">
	    		<input type="text" value="" placeholder="Prezime"/>
			</div></td>
			<td><div class="input-control text">
	    		<input type="text" value="" placeholder="Adresa"/>
			</div></td>
		</tr>
		@foreach ($passangers as $passanger)
		<tr>
			<td>{{ $passanger->name }}</td>
			<td>{{ $passanger->surname }}</td>
			<td>{{ $passanger->address }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop