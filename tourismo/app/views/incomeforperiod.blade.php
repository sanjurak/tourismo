@extends('home')
@section('content')

{{HTML::script('scripts/incomeforperiod.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Zarada za period</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
@include('searchArea')

<p/>
<div  id="incomeData">
	{{ $incomeForPeriodPartial }}
</div>

@stop