@extends('home')
@section('content')

TODO::napraviti AJAX forme
<div id="basicsearch">
	{{ Form::open(array('url' => 'basicSearch')) }}
	{{Form::label("Pretraživanje prema nazivu zemlje ili grada:")}} {{Form::text('search_item', null, array('id'=>'basic'))}}
	{{ Form::submit('Traži',['class' => 'btn btn-primary']) }}
	 {{ Form::close() }}
	 <button class="btn btn-success" id="advanced">Napredna pretraga</button>
	 <button class="btn btn-warning" id="breset">Resetuj pretragu</button>
</div>
<div id="advancedSearch">
	{{ Form::open(array('url' => 'advancedSearch')) }}
	Kategorija: TODO::dropdown lista <br/>
	Zemlja: TODO::dropdown lista <br/>
	Grad: TODO::dropdown lista <br/>
	Agencija: TODO::dropdown lista <br/>
	{{ Form::submit('Submit') }}
	 {{ Form::close() }}
</div>

<div id="list_view">
	
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
		<td>{{$destination->town}}</td>
		<td>{{$destination->description}}</td>
		<td>TO DO::spisak agencija koje nude destinaciju, lonkovano ka aranzmanima</td>
	</tr>
@endforeach
</table>
</div>

@stop