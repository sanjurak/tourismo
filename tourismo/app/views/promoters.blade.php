@extends('home')
@section('content')

{{HTML::script('scripts/promoters.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Promoteri</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
@include('searchArea')

<p/>
<div  id="passangersData">
	{{ $promotersPartial }}
</div>

@stop