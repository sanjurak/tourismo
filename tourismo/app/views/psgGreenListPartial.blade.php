<?php $i = 0; ?>
<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td></td>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Mobilni</td>
			<td>Broj Pasoša</td>
			<!-- <td>JMBG</td> -->
			<!-- <td>Broj rezervacije</td> -->
			<!-- <td>Polazak</td> -->
			<td>Destinacija</td>
			<td>Smeštaj</td>
			<td>Napomena/Prevoz</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($passangers as $passanger)
	<tr>
		<td>{{ ++$i.'.' }}</td>
		<td>{{ $passanger->name }}</td>
		<td>{{ $passanger->surname }}</td>
		<td>{{ $passanger->mob }}</td>
		<td>{{ $passanger->passport }}</td>
		<!-- <td>{{ $passanger->jmbg }}</td> -->
		<!-- <td>{{ $passanger->reservation_number }}</td> -->
		<!-- <td>{{ $passanger->travel_date }}</td> -->
		<td>{{ $passanger->country.', '.$passanger->town }}</td>
		<td>{{ $passanger->type.', '.$passanger->acc_name }}</td>
		<td>{{ $passanger->note.'/'.$passanger->transportation }}</td>
	</tr>
	@endforeach
	</tbody>
</table>