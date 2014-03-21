@extends('layout')
@section('content')
{{ Input::get('message') }}
<h1><a href="homepage">
		<i class="icon-arrow-left-3 fg-darker smaller"></i>
	</a>Putnici</h1>
<?php $passangers = Passanger::paginate(10); ?>
{{ $passangers->links() }}
<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Adresa</td>
			<td>Pol</td>
			<td>Telefon</td>
			<td>Mobilni</td>
			<td>Datum rođenja</td>
			<td>Broj Pasoša</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			{{ Form::open(array('url' => 'storePassanger')) }}
			<td><div class="input-control text">
	    		<input type="text" name="name" value="" placeholder="Ime"/>
			</div></td>
			<td><div class="input-control text">
	    		<input type="text" name="surname" value="" placeholder="Prezime"/>
			</div></td>
			<td><div class="input-control text">
	    		<input type="text" name="address" value="" placeholder="Adresa"/>
			</div></td>
			<td><div class="input-control select">
				<select name="gender" id="gender">
					<option value="m">m</option>
					<option value="f">f</option>
				</select>
			</div></td>
			<td><div class="input-control text">
				<input type="text" name="tel" value="" placeholder="Telefon"/>
			</div></td>
			<td><div class="input-control text">
				<input type="text" name="mob" value="" placeholder="Mobilni"/>
			</div></td>
			<td><div class="input-control text" id="datepicker">
			    <input type="text" name="birth_date"/>
			    <button class="btn-date"></button>
			</div></td>
			<td><div class="input-control text">
				<input type="text" name="passport" value="" placeholder="Broj Pasoša"/>
			</div></td>
			<td><input type="submit" value="Submit"></td>
			{{ Form::close() }}
		</tr>
		@foreach ($passangers as $passanger)
		<tr>
			<td>{{ $passanger->name }}</td>
			<td>{{ $passanger->surname }}</td>
			<td>{{ $passanger->address }}</td>
			<td>{{ $passanger->gender }}</td>
			<td>{{ $passanger->tel }}</td>
			<td>{{ $passanger->mob }}</td>
			<td>{{ $passanger->birth_date }}</td>
			<td>{{ $passanger->passport }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
    $("#datepicker").datepicker();
</script>

@stop