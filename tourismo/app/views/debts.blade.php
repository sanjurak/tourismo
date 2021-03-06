@extends('home')
@section('content')

{{HTML::script('scripts/debts.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Dugovanja</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
@include('searchArea')
<br>
<div class="container" id="reservations">
<div class="row">

	<div class="row">
		<div id="debtsPartial">
			{{$debtsPartial}}
		</div>
	</div>
</div>

@stop