@extends('home')

@section('javascripts')
	{{HTML::script('scripts/organizators.js')}}
@stop

@section('content')
<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Organizatori</a></li>
	    </ul>
	</nav>
</div>
</br>

<div id="orgBasicSearch" class="row">
	<div class="container">
		<div class='form-search'>
			<select name='search_item' id='basicOrg' placeholder="Pretraživanje prema nazivu, e-mail-u, adresi i web sajtu organizatora" class='form-control'></select>
		</div>
		<div class="">
			 <a role="button" class="btn btn-default btn-small" id="bresetOrg">Resetuj pretragu</a>
			 <!--<a role="button" class="btn btn-small" id="advanced">Napredna pretraga</a>-->
		</div>
	</div>
</div>

<!--
<div id="advancedSearch" class="row">
		<div class="span12">
			<fieldset>
				<legend>Napredna pretraga organizatora</legend>
				{{ Form::open(array('id' => 'advancedSearchFormOrg', 'class' => 'form-inline form-search')) }}
				<div class="row">
					<div class="span3"><label>PIB:</label> {{Form::select('pibs',$pibs,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Matični broj:</label> {{Form::select('matbrs',$matbrs,'0',array('class' => 'input-medium'))}}</div>
					<div class="span3"><label>Naziv:</label> {{Form::select('names',$names,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Adresa:</label> {{Form::select('addresses',$addresses,'0',array('class' => 'input-medium'))}} </div>
				</div>	
				<div class="row">	
					<div class="span3"><label>Email:</label> {{Form::select('emails',$emails,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Web sajt:</label> {{Form::select('webs',$webs,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Telefon:</label> {{Form::select('phones',$phones,'0',array('class' => 'input-medium'))}} </div>
				</div>
				<div class="row">
					<div class="span4 pull-left">{{ Form::submit('Traži',['class' => 'btn btn-primary']) }}</div>
				</div>
				 {{ Form::close() }}
			 </fieldset>
		 </div>
	</div>
-->
<div class="row">
	<div class="container">
		<a class="btn btn-primary btn-small pull-right" role="button" data-toggle="modal" href="#newOrgModal" id="novaDst">Dodaj novog organizatora</a>
	</div>
</div>

<div class="row">
	<div id="list_view" class="container">
	{{$orgzPartial}}
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="newOrgModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Dodavanje novog organizatora</h3>
			</div>

			<div class="modal-body">
				<form id="newOrgForm" name="newOrgForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="pib">PIB:</label>
				    <div class="controls">
				      <input type="text" id="pibModNew" name="pib" placeholder="PIB" class="validate[required]" />
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="mat_br">Matični broj:</label>
				    <div class="controls">
				      <input type="text" id="mat_brModNew" name="mat_br" placeholder="Matični broj">
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="name">Naziv</label>
				    <div class="controls">
				      <input type="text" id="nameModNew" name="name" class="validate[required]" placeholder="Naziv">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="email">E-mail</label>
				    <div class="controls">
				      <input type="text" id="emailModNew" name="email" class="validate[required]" placeholder="E-mail">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="address">Adresa</label>
				    <div class="controls">
				      <input type="text" id="addressModNew" name="address" placeholder="Adresa">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="phone">Telefon</label>
				    <div class="controls">
				      <input type="text" id="phoneModNew" name="phone" placeholder="Telefon">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="web">Web sajt</label>
				    <div class="controls">
				      <input type="text" id="webModNew" name="web" placeholder="Web sajt">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="provision">Provizija</label>
				    <div class="controls">
				      <input type="text" id="provisionModNew" name="provision" placeholder="Provizija">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="licence">Broj Licence</label>
				    <div class="controls">
				      <input type="text" id="lecenceModNew" name="licence" placeholder="Broj licence">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="bankaccount">Br. Računa</label>
				    <div class="controls">
				      <input type="text" id="bankaccountModNew" name="bankaccount" placeholder="Broj računa">
				    </div>
				  </div>
				</form>

			</div>

			<div class="modal-footer">  
				<a id="newOrgBtn" class="btn btn-success">Sačuvaj</a>  
				<a  id="closeNewOrgModal" class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="editOrgModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Izmena</h3>
			</div>

			<div class="modal-body">
				<form id="editOrgForm" name="editOrgForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="pib">PIB:</label>
				    <div class="controls">
				      <input type="text" id="pibMod" name="pib" placeholder="PIB" class="validate[required]" />
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="mat_br">Matični broj:</label>
				    <div class="controls">
				      <input type="text" id="mat_brMod" name="mat_br" placeholder="Matični broj">
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="name">Naziv</label>
				    <div class="controls">
				      <input type="text" id="nameMod" name="name" class="validate[required]" placeholder="Naziv">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="email">E-mail</label>
				    <div class="controls">
				      <input type="text" id="emailMod" name="email" class="validate[required]" placeholder="E-mail">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="address">Adresa</label>
				    <div class="controls">
				      <input type="text" id="addressMod" name="address" placeholder="Adresa">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="phone">Telefon</label>
				    <div class="controls">
				      <input type="text" id="phoneMod" name="phone" placeholder="Telefon">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="web">Web sajt</label>
				    <div class="controls">
				      <input type="text" id="webMod" name="web" placeholder="Web sajt">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="provision">Provizija</label>
				    <div class="controls">
				      <input type="text" id="provisionMod" name="provision" placeholder="Provizija">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="licence">Broj Licence</label>
				    <div class="controls">
				      <input type="text" id="licenceMod" name="licence" placeholder="Broj licence">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="bankaccount">Br. Računa</label>
				    <div class="controls">
				      <input type="text" id="bankaccountMod" name="bankaccount" placeholder="Broj računa">
				    </div>
				  </div>
				</form>

			</div>

			<div class="modal-footer">  
				<a id="editOrgBtn" class="btn btn-success">Sačuvaj</a>  
				<a  id="closeOrgModal" class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="deleteOrgModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3><span class="icon icon-warning-sign"></span>Upozorenje!</h3>
			</div>

			<div class="modal-body">
				Potvrda brisanja organizatora...
				<input type="hidden" id="pibDel" name="pibDel" />

			</div>

			<div class="modal-footer">  
				<a id="deleteConfirmed" class="btn btn-success">Obriši</a>  
				<a  id="deleteCanceled" class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

@stop