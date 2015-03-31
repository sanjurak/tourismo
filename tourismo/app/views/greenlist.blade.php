@extends('home')
@section('content')

{{HTML::script('scripts/psggreenlist.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Zelena lista</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
@include('searchArea')

<br>
<p/>
<div  id="passangersData">
	{{ $psgGreenListPartial }}
</div>

@stop