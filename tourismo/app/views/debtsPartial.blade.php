


<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime i Prezime</td>
			<td>Adresa</td>
			<td>Mobilni</td>
			<td>JMBG</td>
			<td>Dugovanje EUR</td>
			<td>Dugovanje DIN</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($debts as $debt)
	<tr>
		<td>
			{{ $debt->passanger_name }}</td>
		<td>
			{{ $debt->passanger_address }}</td>
		<td>
			{{ $debt->passanger_tel }}</td>
		<td>
			{{ $debt->passanger_jmbg }}</td>
		<td>
			{{ $debt->debt_eur }}</td>
		<td>
			{{ $debt->debt_din }}</td>
	</tr>
	@endforeach
	</tbody>
</table>