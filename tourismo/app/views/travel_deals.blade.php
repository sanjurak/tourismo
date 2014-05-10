@extends('home')
@section('content')

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Aranžmani</a></li>
	    </ul>
	</nav>
</div>
</br>

@include('notifications')

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

<div class="row">
	<div class="span9">
		<div id="trvlDlsDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Detalji aranžmana</h3>
			</div>
			{{ Form::open(array('url' => 'storeTravelDeal', 'name' => 'addNewTrvlDlsForm', 'id' => 'addNewTrvlDlsForm' )) }}
			<div class="modal-body">
			</br>
				<table class="table striped">
					<tr>
						<td><div class="input-control text">
							<input type="text" name="category" id="category" class="validate[required]" placeholder="Kategorija"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="destination" id="destination" class="validate[required]" placeholder="Destinacija"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="organizer" id="organizer" class="validate[required]" placeholder="Organizator"/>
						</div></td>
					</tr>
					<tr>
						<td><div class="input-control text">
							<input type="text" name="accom_type" id="accom_type" class="validate[required]" placeholder="Tip Smeštaja"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="accom_name" id="accom_name" class="validate[required]" placeholder="Naziv Smeštaja"/>
						</div></td>
						 <td><div class="input-control text">
							<input type="text" name="transportation" id="transportation" placeholder="Prevoz"/>
						 </div></td>
					</tr>
					<tr>
						<td><div class="input-control text">
							<input type="text" name="service" id="service" placeholder="Tip usluge"/>
						 </div></td>
						<td><div class="input-control text">
							<input type="text" name="price_din" id="price_din" class="validate[required]" placeholder="Cena (DIN)"/>
						 </div></td>
						<td><div class="input-control text">
							<input type="text" name="price_eur" id="price_eur" placeholder="Cena (EUR)"/>
						</div></td>
					</tr>
				</table>
				<input type="hidden" name="id" id="id"/>
			</div>

			<div class="modal-footer">  
				<button type="submit" id="addNewTrvlDls" class="btn btn-success">Sačuvaj</button>
				<a class="btn" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop