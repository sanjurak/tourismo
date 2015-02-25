<table class="table striped">
	<thead style="font-weight:bold">
		@if ($total_income_din = 0) @endif
		@if ($total_income_eur = 0) @endif
		@foreach ($incomes as $income)
			@if ($total_income_din = $total_income_din + $income->amount_din) @endif
			@if ($total_income_eur = $total_income_eur + number_format(floatval($income->amount_eur_din/$income->exchange_rate), 2)) @endif
		@endforeach
		<tr>
			<th colspan='4'>TOTAL</th>
			<th>{{ number_format($total_income_eur, 2) }} EUR</th>
			<th>{{ number_format($total_income_din, 2) }} DIN<th>
		</tr>
		<tr>
			<td>Broj rezervacije</td>
			<td>Datum polaska</td>
			<td>Destinacija</td>
			<td>Datum uplate</td>
			<td>Iznos EUR</td>
			<td>Iznos DIN</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($incomes as $income)
	<tr class='income-row' name='{{ $income->reservation_id }}'>
		<td>
			<a name="contract{{$income->reservation_id}}" id="printContract" href="contract/{{$income->reservation_id}}" target="_blank" title="Štampa ugovora">
                    {{ $income->reservation_number }}
                </a></td>
		<td>
			{{ $income->travel_date }}</td>
		<td>
			{{ $income->country.', '.$income->town }}</td>
		<td>
			{{ $income->date }}</td>
		<td>
			{{ number_format(floatval($income->amount_eur_din/$income->exchange_rate), 2) }}€</td>
		<td>
			{{ number_format($income->amount_din, 2) }}</td>
	</tr>
	@endforeach
	</tbody>
</table>