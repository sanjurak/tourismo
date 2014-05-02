<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Sredstvo plaćanja</td>
			<td>Ime i jmbg putnika</td>
			<td>Broj rezervacije</td>
			<td>Datum uplate</td>
			<td>Kurs Eura</td>
			<td>Iznos (din)</td>
			<td>Iznos (eur)</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@foreach ($payments as $payment)
		<tr>
			<td>{{ $payment->payment_type }}
				@if ($payment->payment_type == "kartica")
					{{ ' ('.$payment->card_type.')' }}
				@endif
			</td>
			<td>{{ $payment->passanger->name}} {{ $payment->passanger->surname }}, {{ $payment->passanger->jmbg }}</td>
			<td>{{ $payment->reservation->reservation_number }}</td>
			<td>{{ $payment->date }}</td>
			<td>{{ $payment->exchange_rate }}</td>
			<td>{{ $payment->amount_din }}</td>
			<td>{{ floatval($payment->amount_eur_din)/floatval($payment->exchange_rate) }}</td>
			<td>
				<a class="paymentDetails btn btn-primary pull-right" name="{{$payment->id}}" role="button" data-toggle="modal" href="#paymentDetailModal">
				<span class="icon-edit"></span>
			</td>
		</tr>
	@endforeach
</table>