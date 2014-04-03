{{HTML::script('scripts/travel_deals.js')}}
<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Kategorija</td>
			<td>Destinacija</td>
			<td>Tip Smeštaja</td>
			<td>Naziv Smeštaja</td>
			<td>Prevoz</td>
			<td>Usluga</td>
			<td>Cena (DIN)</td>
			<td>Cena (EUR)</td>
		</tr>
	</thead>
	<tbody>
	@if ($travel_deals != null)
		@foreach ($travel_deals as $travel_deal)
		<tr>
			<td>
				{{ $travel_deal->category->name }}
			</td>
			<td>
				{{ $travel_deal->destination->name }}
			</td>
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
				<a class="trvlDealsDetails btn btn-primary pull-right" name="{{$travel_deal->id}}" role="button" data-toggle="modal" href="#trvlDealsDetailModal">
				<span class="icon-edit"></span>
			</td>
			<td>
				<a href="deleteTravelDeal/{{(string)$travel_deal->id}}" class="btn btn-danger pull-right">
				<span class="icon-trash"></span>
			</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>
