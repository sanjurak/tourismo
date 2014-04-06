@extends('home')
@section('content')

<h1><a href="homepage"><i class="icon-circle-arrow-left large"></i></a>
	Aranžmani
</h1>

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
		 <a role="button" class="span2 trvlDealsDetails btn btn-default btn-small" id="addNewTrvlDeal" data-toggle="modal" href="#trvlDlsDetailModal">Dodaj novi aranžman</a>
	</div>
</div>

@if ($travel_deals != null)
	{{ $travel_deals->links() }}
@endif

<p/>
<div  id="list_view">
	{{ $trvlDealsPartial }}
</div>


@stop