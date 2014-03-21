
{{$res}}
<table class="table table-hover">
		<tr>
			<th>Kategorija</th>
			<th>Zemlja</th>
			<th>Grad</th>
			<th>Opis</th>
			<th>Lista aranžmana</th>
		</tr>
@foreach($destinations as $destination)
	<tr>
		<td>TO DO::letovanje, zimovanje ...</td>
		<td>
			<a href="#" class="editableC" id="country" data-type="text" data-pk= {{$destination->id}} data-url="/destinationEdit/{{$destination->id}}" data-title="Unesite naziv zemlje">
				{{$destination->country}}
			</a>
		</td>
		<td>
			<a href="#" class="editableC" id="town" data-type="text" data-pk= {{$destination->id}} data-url="/destinationEdit/{{$destination->id}}" data-title="Unesite naziv grada/mesta">
						{{$destination->town}}
			</a>
		</td>
		<td>
			<a href="#" class="editableC" id="description" data-type="text" data-pk= {{$destination->id}} data-url="/destinationEdit/{{$destination->id}}" data-title="Unesite opis destinacije">
						{{$destination->description}}
			</a>
		</td>
		<td>TO DO::spisak agencija koje nude destinaciju, lonkovano ka aranzmanima</td>
	</tr>
@endforeach
</table>