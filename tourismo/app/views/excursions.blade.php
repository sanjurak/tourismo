@extends('home')
@section('content')
<!-- {{HTML::script('scripts/users.js')}} -->

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Izveštaj o izletima</a></li>
	    </ul>
	</nav>
</div>
</br>

@include('notifications')

@stop