@extends('home')
@section('content')
{{HTML::script('scripts/passangers.js')}}
<h1><a href="homepage"><i class="icon-circle-arrow-left large"></i></a>
	Putnici
</h1>

<div id="basicsearch" class="row">
	<div class='form-search'>
		<select name='search_item' id='basicPsgSearch' placeholder="Pretraživanje prema jmbg, imenu, prezimenu ili adresi" class='form-control'></select>
	</div>
	<div class="">
		 <a role="button" class="btn btn-default btn-small" id="bresetPsg">Resetuj pretragu</a>
	</div>
</div>

{{ $passangers->links() }}

{{ Form::open(array('url' => 'storePassanger', 'name' => 'addNewPsgForm', 'id' => 'addNewPsgForm' )) }}
<table class="table striped">
	<tr>
	<td><div class="input-control text">
		<input type="text" name="name" value="" id="name" class="validate[required]" placeholder="Ime" tabindex="1"/>
	</div></td>
	<td><div class="input-control text">
		<input type="text" name="surname" value="" id="surname" class="validate[required]" placeholder="Prezime" tabindex="2"/>
	</div></td>
	<td><div class="input-control text">
		<input type="text" name="address" value="" id="address" class="validate[required]" placeholder="Adresa" tabindex="3"/>
	</div></td>
	<!-- 
	<td style="padding:3px"><div class="input-control select" style="padding:0px">
		<select name="gender" id="gender">
			<option value="m" tabindex="4">m</option>
			<option value="f">f</option>
		</select>
	</div></td>
	<td style="padding:3px"><div class="input-control text" style="padding:0px">
		<input type="text" name="tel" value="" placeholder="Telefon" tabindex="5"/>
	</div></td>
	<td style="padding:3px"><div class="input-control text" style="padding:0px">
		<input type="text" name="mob" value="" placeholder="Mobilni" tabindex="6"/>
	</div></td>
	<td style="padding:3px"><div class="input-control text input-append date" id="birth_datepicker" style="padding:0px">
		<input type="text" style="height:100%" class="span2" name="birth_date" placeholder="yyyy/mm/dd" tabindex="7"/>
		<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
	</div></td>
	<td style="padding:3px"><div class="input-control text" style="padding:0px">
		<input type="text" name="passport" value="" placeholder="Broj Pasoša" tabindex="8"/>
	</div></td>
	 -->
	 <td><div class="input-control text">
		<input type="text" name="jmbg" value="" placeholder="JMBG" tabindex="4"/>
	</div></td>
	<td><button type="submit" class="btn btn-primary input" tabindex="5" style="height:100%;font-size:30px">+</td>
	</tr>
</table>

{{ Form::close() }}

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