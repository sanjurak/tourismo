@extends('home')
@section('content')
{{HTML::script('scripts/passangers.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Putnici</a></li>
	    </ul>
	</nav>
</div>
</br>

<div id="basicsearch" class="row">
	<div class='form-search'>
		<select name='search_item' id='basicPsgSearch' placeholder="Pretraživanje prema jmbg, imenu, prezimenu ili adresi" class='form-control'></select>
	</div>
	<div class="">
		 <a role="button" class="btn btn-default btn-small" id="bresetPsg">Resetuj pretragu</a>
		 <a role="button" class="passangerDetails btn btn-default btn-small" id="addNewPsg" data-toggle="modal" href="#psgDetailModal">Dodaj novog putnika</a>
	</div>
</div>

{{ $passangers->links() }}

<p/>
<div  id="passangersData">
	{{ $psgPartial }}
</div>

<div class="row">
	<div class="span9">
		<div id="psgDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Detalji putnika</h3>
			</div>
			{{ Form::open(array('url' => 'storePassanger', 'name' => 'addNewFullPsgForm', 'id' => 'addNewFullPsgForm' )) }}
			<div class="modal-body">
				<table class="table striped">
					<tr>
						<td><div class="input-control text">
							<input type="text" name="name" id="name" class="validate[required]" placeholder="Ime"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="surname" id="surname" class="validate[required]" placeholder="Prezime"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="address" id="address" class="validate[required]" placeholder="Adresa"/>
						</div></td>
					</tr>
					<tr>
						<td><div class="input-control text">
							<input type="text" name="tel" id="tel" placeholder="Telefon"/>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="mob" id="mob" placeholder="Mobilni"/>
						</div></td>
						 <td><div class="input-control text">
							<input type="text" name="jmbg"  class="validate[required]" id="jmbg" placeholder="JMBG"/>
						 </div></td>
					</tr>
					<tr>
						<td><div class="input-control select">
							<select name="gender" id="gender">
								<option value="" disabled selected="selected" style='display:none;'>Pol...</option>
								<option value="m">m</option>
								<option value="f">f</option>
							</select>
						</div></td>
						<td><div class="input-control text input-append date" id="birth_datepicker">
							<input type="text" style="height:100%" class="span2" id="birth_date" name="birth_date" placeholder="yyyy/mm/dd"/>
							<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
						</div></td>
						<td><div class="input-control text">
							<input type="text" name="passport" id="passport" placeholder="Broj Pasoša"/>
						</div></td>
					</tr>
				</table>
				<input type="hidden" name="id" id="id"/>
			</div>

			<div class="modal-footer">  
				<button type="submit" id="addNewPsg" class="btn btn-success">Sačuvaj</button>
				<a class="btn" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop