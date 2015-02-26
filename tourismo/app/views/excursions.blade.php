@extends('home')
@section('content')

{{HTML::script('scripts/excursions.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Izveštaj o izletima</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
@include('searchArea')

<div class="container" id="excursions">
	<div class="row">
		<div id="excursionsData">
			{{$excursionsPartial}}
		</div>
	</div>
</div>

@stop