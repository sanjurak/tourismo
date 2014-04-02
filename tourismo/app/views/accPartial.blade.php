<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>

<table class="table table-hover">
		<tr>
			<th>Tip</th>
			<th>Naziv</th>
			<th>Destinacija</th>
			<th></th>
		</tr>
@foreach($accomodations as $accomodation)
	<tr>
		<td>
			<a href="#" class="editableC" id="type" data-type="text" data-pk= {{$accomodation->id}} data-url="/accommodationEdit/{{$accomodation->id}}" data-title="Unesite tip smeštaja">{{$accomodation->type}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="name" data-type="text" data-pk= {{$accomodation->id}} data-url="/accommodationEdit/{{$accomodation->id}}" data-title="Unesite naziv smeštaja">{{$accomodation->name}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="destination_id" data-value={{$accomodation->destination->id}} data-source="accommodationDstList" data-type="select" data-pk= {{$accomodation->id}} data-url="/accommodationEdit/{{$accomodation->id}}" data-title="Destinacija kojoj pripada smeštaj">
				{{$accomodation->destination->town}},{{$accomodation->destination->country}}
			</a>
		</td>
		<td></td>
	</tr>
@endforeach
</table>