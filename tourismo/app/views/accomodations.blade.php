@extends('home')

@section('javascripts')
	{{HTML::script('scripts/accommodations.js')}}
@stop

@section('content')

<div id="accBasicSearch" class="row">
	<div class="container">
		<div class='form-search'>
			<select name='search_item' id='basicAcc' placeholder="Pretraživanje prema tipu smeštaja, nazivu i destinaciji" class='form-control'></select>
		</div>
		<div class="">
			 <a role="button" class="btn btn-default btn-small" id="bresetAcc">Resetuj pretragu</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="container">
		<a class="btn btn-primary btn-small pull-right" role="button" data-toggle="modal" href="#newAccModal" id="newAcc">Dodaj nov smeštaj</a>
	</div>
</div>

<div class="row">
	<div id="list_view" class="container">
	{{$accPartial}}
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="newAccModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
	<div class="modal-header">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Dodavanje novog smeštaja</h3>
	</div>

	<div class="modal-body">
		<form id="newAccForm" name="newAccForm" class="form-horizontal">
		  <div class="control-group">
		    <label class="control-label" for="type">Tip smeštaja:</label>
		    <div class="controls">
		    	<select name='type' id='typeModNew' placeholder="Tip smeštaja" class='form-control'></select>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="name">Naziv:</label>
		    <div class="controls">
		      <input type="text" id="nameModNew" name="name" class="form-control validate[required]" placeholder="Naziv">
		    </div>
		  </div>
		   <div class="control-group">
		    <label class="control-label" for="name">Destinacija</label>
		    <div class="controls">
		      {{Form::select('destination_id',$destinations,'0',array('class' => 'input-medium form-control validate[required]'))}} 
		    </div>
		  </div>
		  <div class="control-group" id="units">
		  	<a href="#" id="addUnit" class="btn">Dodaj smeštajnu jedinicu</a>
		  </div>
		</form>
	</div>

	<div class="modal-footer">  
		<a id="newAccBtn" class="btn btn-success">Sačuvaj</a>  
		<a  id="closeNewAccModal" class="btn" data-dismiss="modal">Odustani</a>  
			
	</div> 
</div>
	</div>
</div>


<div id="unitsId" class="hiddenUnit">
	<div class="form-inline">
		<fieldset>
			<legend>Smestajna jedinica</legend>
					    	<!--<select name='nameUnit[]' class='nameUnitModNew' placeholder="Tip smeštajne jedinice" class='form-control'></select>-->
		    	 <input type="text" id="nameUnitModNew" class="form-control validate[required]" placeholder="Tip smeštajne jedinice:">

		      <input type="text" id="capacityUnitModNew" class="form-control validate[required]" placeholder="Kapacitet">
		      <input type="text" id="numberUnitModNew" class="form-control validate[required]" placeholder="Broj jedinica">

		</fieldset>

		  </div>
</div>

<div class="row">
	<div class="span7">
		<div id="deleteAccModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3><span class="icon icon-warning-sign"></span>Upozorenje!</h3>
			</div>

			<div class="modal-body">
				Potvrda brisanja smestaja...
				<input type="hidden" id="pibDel" name="pibDel" />

			</div>

			<div class="modal-footer">  
				<a id="deleteAccConfirmed" class="btn btn-success">Obriši</a>  
				<a  id="closeDelOrg" class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

@stop