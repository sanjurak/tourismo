{{HTML::script('scripts/travel_deals.js')}}
<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Tip Smeštaja</td>
			<td>Naziv Smeštaja</td>
			<td>Prevoz</td>
			<td>Usluga</td>
			<td>Cena u dinarima</td>
			<td>Cena u eurima</td>
			<td>Organizator</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($travel_deals as $travel_deal)
	<tr>
		<td>
			{{ $travel_deal->accomodations->type }}
		</td>
		<td>
			{{ $travel_deal->accomodations->name }}
		</td>
		<td>
			{{ $travel_deal->transportation }}
		</td>
		<td>
			{{ $travel_deal->service }}
		</td>
		<td>
			{{ $travel_deal->price_din }}
		</td>
		<td>
			{{ $travel_deal->price_eur }}
		</td>
		<td>
			{{ $travel_deal->organizer->name }}
		</td>
		<td>
			<a class="trvlDealsDetails btn btn-primary pull-right" name="{{$travel_deal->id}}" role="button" data-toggle="modal" href="#trvlDealsDetailModal">
			<span class="icon-edit"></span>
		</td>
		<td>
			<a href="deleteTravelDeal/{{(string)$travel_deal->id}}" class="btn btn-danger pull-right">
			<span class="icon-trash"></span>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
