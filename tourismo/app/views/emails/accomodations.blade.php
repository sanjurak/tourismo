@extends('home')
@section('content')

TODO::napraviti AJAX forme


<div id="list_view">
	
	<table class="table table-hover">
		<tr>
			<th>Tip</th>
			<th>Naziv</th>
			<th>Destinacija</th>
			<th>Jedinice</th>
		</tr>
@foreach($accomodations as $accomodation)
	<tr>
		<td>{{$accomodation->type}}</td>
		<td>
			<a href="#" class="editableC" id="name" data-type="text" data-pk= {{$accomodation->type}} data-url="/accomodationEdit/{{$accomodation->id}}" data-title="Unesite naziv smeštaja">
				{{$accomodation->name}}
			</a>
		</td>
		<td>{{$accomodation->destination()}}</td>
		<td></td>
	</tr>
@endforeach
</table>
</div>

@stop