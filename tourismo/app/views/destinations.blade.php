@extends('home')
@section('content')

<div id="basicsearch">
	<div class=' '>
		
		<select name='search_item' id='basic' placeholder="Pretraživanje prema nazivu zemlje ili grada" class='form-controlx	x	'></select>

		<br/>
		 <button class="btn btn-small" id="advanced">Napredna pretraga</button>
		 <button class="btn btn-small" id="breset">Resetuj pretragu</button>
	</div>
</div>
<div id="advancedSearch">
	{{ Form::open(array('url' => 'advancedSearch')) }}
	Kategorija: TODO::dropdown lista <br/>
	Zemlja: TODO::dropdown lista <br/>
	Grad: TODO::dropdown lista <br/>
	Agencija: TODO::dropdown lista <br/>
	
	{{ Form::submit('Traži',['class' => 'btn btn-primary']) }}
	 {{ Form::close() }}
</div>

<div id="list_view">
{{$destPartial}}
</div>

@stop