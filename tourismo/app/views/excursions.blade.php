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
<br>
<div id="basicfilter" class="row">
	<div class='form-search span3'>
		<select name='category_name' id='categoriesSelect' placeholder="Kategorija" class='form-control'></select>
	</div>
	<div class='form-search span3'>
		<select name='destination_country_town' id='dstCountryTownSelect' placeholder="Država" class='form-control'></select>
	</div>
	<div class="form-search span3 input-controll text input-append date" id="from_datepicker">
		<input type="text" style="height:100%" class="span3" id="from_date" name="from_date" placeholder="from d-m-yy"/>
		<!-- <span class="add-on" style="height:100%"><i class="icon-calendar"></i></span> -->
	</div>
	<div class="form-search span3 input-controll text input-append date" id="to_datepicker">
		<input type="text" style="height:100%" class="span3" id="to_date" name="to_date" placeholder="to d-m-yy"/>
		<!-- <span class="add-on" style="height:100%"><i class="icon-calendar"></i></span> -->
	</div>
	<div class="form-search span1">
		<a role="button" class="span1 btn btn-default btn-small" id="searchBtn">Prikaži</a>
	</div>
</div>
<div id="basicButtons" class="row"> 
	<div class="">
		 <a role="button" class="span2 btn btn-default btn-small" id="bresetTrvlDls">Resetuj pretragu</a>
	</div>
</div>

<div class="container" id="excursions">
	<div class="row">
		<div id="excursionsData">
			{{$excursionsPartial}}
		</div>
	</div>
</div>

@stop