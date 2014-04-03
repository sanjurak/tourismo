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
		<td>
			<span data-content="{{$accomodation->unitsHTML}}" acc-id={{$accomodation->id}} data-html="true" data-trigger="hover" rel="tooltip" class="btn btn-default unit">
				<i class="icon-home"></i>
			</span>
			<a href="#" data-content="Dodaj novu smestajnu jedinicu" data-id={{$accomodation->id}} class="btn btn-warning addUnit" data-trigger="hover" rel="tooltip">
				<span class="icon-plus-sign"></span>
			</a>	
			<a href="#" class="btn btn-danger deleteAcc" data-id={{$accomodation->id}}} data-content="Brisanje podataka o smeštaju" data-trigger="hover" rel="tooltip">
				<span class="icon-trash"></span>
			</a>	
		</td>
	</tr>
@endforeach
</table>