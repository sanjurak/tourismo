
<table class="table striped">
	<thead style="font-weight:bold">
		@if ($total_dept_din = 0) @endif
		@if ($total_dept_eur = 0) @endif
		@foreach ($debts as $debt)
			@if ($total_dept_din = $total_dept_din + $debt->debt_din) @endif
			@if ($total_dept_eur = $total_dept_eur + $debt->debt_eur) @endif
			{{var_dump($debt)}}
		@endforeach
		<tr>
			<th colspan='4'>TOTAL</th>
			<th>{{ number_format($total_dept_eur, 2) }} EUR</th>
			<th>{{ number_format($total_dept_din, 2) }} DIN<th>
		</tr>
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
	<tr class='debt-row'>
		<td>
			{{ $debt->passanger_name }}</td>
		<td>
			{{ $debt->passanger_address }}</td>
		<td>
			{{ $debt->passanger_tel }}</td>
		<td>
			{{ $debt->passanger_jmbg }}</td>
		<td>
			{{ number_format($debt->debt_eur, 2) }}</td>
		<td>
			{{ number_format($debt->debt_din, 2) }}</td>
	</tr>
	@endforeach
	</tbody>
</table>