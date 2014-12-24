@extends('home')
@section('content')

{{HTML::script('scripts/psgforperiod.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li><a href="reports">Izveštaji</a></li>
	        <li class="active"><a href="#">Lista putnika za period</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')
<br>
<div id="basicfilter" class="row">
	<div class='form-search span3'>
		<select name='category_name' id='categoriesSelect' placeholder="Kategorija" class='form-control'></select>
	</div>
	<div class='form-search span3'>
		<select name='destination_country_town' id='dstCountryTownSelect' placeholder="Država" class='form-control'></select>
	</div>
</div>
<div id="basicButtons" class="row"> 
	<div class="">
		 <a role="button" class="span2 btn btn-default btn-small" id="bresetTrvlDls">Resetuj pretragu</a>
	</div>
</div>

<p/>
<div  id="passangersData">
	{{ $psgForPeriodPartial }}
</div>

@stop