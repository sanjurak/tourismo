@extends('home')
@section('content')

<h1><a href="homepage"><i class="icon-circle-arrow-left large"></i></a>
	Destinacije
</h1>

<div id="basicfilter" class="row">
	<div class='form-search'>
		<select name='category_name' id='categoriesSelect' placeholder="Kategorija putovanja" class='form-control'></select>
	</div>
	<div class='form-search'>
		<select name='destination_country' id='dstCountrySelect' placeholder="Država" class='form-control'></select>
	</div>
	<div class='form-search'>
		<select name='destination_town' id='dstTownSelect' placeholder="Grad" class='form-control'></select>
	</div>
</div>

{{ $travel_deals->links() }}

<p/>
<div  id="travelDealsData">
	{{ $trvlDealsPartial }}
</div>


@stop