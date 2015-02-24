<script type="text/javascript">
$(function(){
    $('.input-append').click(function(event)
        {
            event.preventDefault();
        });
});
</script>

<table class="table">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime i jmbg putnika</td>
			<td>Broj rezervacije</td>
			<td>Fakultativa</td>
			<td>Dugovanje (din)</td>
			<td>Dugovanje (eur)</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@foreach ($excursions as $excursion)
        <tr class="">
			<td>{{ $excursion->name}} {{ $excursion->surname }}, {{ $excursion->jmbg }}</td>
			<td>
                <a name="contract{{$excursion->res_id}}" id="printContract" href="contract/{{$excursion->res_id}}" target="_blank" title="Štampa ugovora">
                    {{ $excursion->reservation_number }}
                </a>
            </td>
			<td>{{ $excursion->excursionItem }}</td>
			<td>{{ number_format($excursion->amount_din, 2) }}</td>
			<td>{{ number_format($excursion->amount_eur, 2) }}</td>
			<td></td>
		</tr>
	@endforeach
    </tbody>
</table>