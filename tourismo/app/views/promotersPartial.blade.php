<?php $i = 0; ?>
<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td></td>
			<td>Promoter</td>
			<td>Broj rezervacije</td>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Polazak</td>
			<td>Destinacija</td>
			<td>Smeštaj</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($passangers as $passanger)
	<tr>
		<td>{{ ++$i.'.' }}</td>
		<td>{{ $passanger->discount }}</td>
		<td>
			<a name="contract{{$passanger->res_id}}" id="printContract" href="contract/{{$passanger->res_id}}" target="_blank" title="Štampa ugovora">
                    {{ $passanger->reservation_number }}
            </a>
        </td>
		<td>{{ $passanger->name }}</td>
		<td>{{ $passanger->surname }}</td>
		<td>{{ $passanger->travel_date }}</td>
		<td>{{ $passanger->country.', '.$passanger->town }}</td>
		<td>{{ $passanger->type.', '.$passanger->acc_name}}</td>
	</tr>
	@endforeach
	</tbody>
</table>