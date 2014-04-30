@section('javascripts')
	{{HTML::script('scripts/reservationsMain.js')}}
@stop
<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>
<table class="table table-hover">
		<tr>
			<th>Broj rezervacije</th>
			<th>Datum rezervacije</th>
			<th>Organizator putovanja</th>
			<th>Destinacija</th>
			<th>Status rezervacije</th>
			<th></th>
		</tr>
@foreach($reservations as $reservation)
	<tr>
		<td>			
			{{$reservation->reservation_number}}
		</td>
		<td>			
			{{$reservation->reservation_date}}
			
		</td>
		<td>
			{{$reservation->traveldeal->organizer->name}}
		</td>
		<td>
			{{$reservation->traveldeal->destination->name}}
		</td>
		<td>
			{{$reservation->status}}
		</td>
		<td>
			<a role="button" class="paymentNewModal btn btn-default btn-small" name="{{$reservation->id}}" id="addNewPayment" data-toggle="modal" href="#paymentNewModal" title="Dodaj novo plaćanje">
				<span class="icon-plus"></span>
			</a>
		</td>
	</tr>
@endforeach
</table>