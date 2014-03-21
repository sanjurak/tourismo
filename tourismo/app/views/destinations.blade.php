@extends('home')
@section('content')

TODO::napraviti AJAX forme
<div id="basicsearch">
	<div class='form-search'>
		Pretraživanje prema nazivu zemlje ili grada:
		<input type="text" name='search_item' id='basic' class='search-query' />
		<button id='bsearch' class='btn btn-primary'>Traži</button>
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