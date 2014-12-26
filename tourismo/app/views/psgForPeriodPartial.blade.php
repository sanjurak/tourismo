
<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Adresa</td>
			<td>Mobilni</td>
			<td>Broj Pasoša</td>
			<td>JMBG</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($passangers as $passanger)
	<tr>
		<td>{{ $passanger->name }}</td>
		<td>{{ $passanger->surname }}</td>
		<td>{{ $passanger->address }}</td>
		<td>{{ $passanger->mob }}</td>
		<td>{{ $passanger->passport }}</td>
		<td>{{ $passanger->jmbg }}</td>
	</tr>
	@endforeach
	</tbody>
</table>