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
	</tr>
@endforeach
</table>