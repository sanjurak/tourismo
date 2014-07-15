@extends('home')
@section('content')

{{HTML::script('scripts/travel_deals.js')}}

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
		 <a role="button" class="span2 btn btn-default btn-small" id="addNewTrvlDeal">Dodaj novi aranžman</a>
	</div>
</div>

<div id="traveldealNew" class="row">
	<div class="span12">
		<div class="container">
			<br/>
			<div class="row">
				<div class="span12">
					<a role="button" class="btn btn-small btn-alert" href="#" id="addCategoryBtn">Dodaj kategoriju</a>

					<a role="button" class="btn btn-small btn-alert" href="#" id="addDestinationBtn">Dodaj destinaciju</a>
				
					<a role="button" class="btn btn-small btn-alert" href="#" id="addOrganizerBtn">Dodaj organizatora</a>
				
					<a role="button" class="btn btn-small btn-alert" href="#" id="addAccomodationBtn">Dodaj smeštaj</a>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<form id="traveldealNewForm" name="traveldealNewForm">
						<div class="container">
						<div class="row">
							<div class="span4">
								<label>Kategorija aranžmana:</label>
								<select name='category' id='categorySel' placeholder="Kategorija" class='form-control'></select>
							</div>
							<div class="span4">
									<label>Organizator aranžmana:</label>
									<select name='organizer' id='organizerSel' placeholder="Organizator" class='form-control'></select>
								</div>
							<div class="span4">
									<label>Destinacija:</label>
									<select name='destination' id='destinationSel' placeholder="Destinacija" class='form-control'></select>
							</div>
						</div>
						<div class="row">						
							<div class="span4">
									<label>Smeštaj:</label>
									<select name='accomodation' id='accomodationSel' placeholder="Smeštaj" class='form-control'></select>
								</div>
							<div class="span4">
									<label>Prevoz:</label>
									<input type="text" name="transportation" id="transportation" class="form-control input-large"/>
								</div>
							<div class="span4">
									<label>Usluga:</label>
									<input type="text" name="service" id="service"/>
							</div>
						</div>
						<div class="row">						
							<div class="span4">
									<label>Cena (din):</label>
									<input type="text" name='priceDin' id='priceDinSel' placeholder="Cena u dinarima" class='form-control' />
								</div>
							<div class="span4">
									<label>Cena (eur):</label>
									<input type="text" name="priceEur" id="priceEurSel" placeholder="Cena u eurima"/>
							</div>
						</div>
						<div class="row">
							<div class="span12">
								<span class="btn btn-default" id="btnAddTravelDeal">Dodaj</span>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

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

<div class="row">
	<div class="span7">
		<div id="addCategoryModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Nova kategorija</h3>
			</div>

			<div class="modal-body">
				<form id="addNewCategoryForm" name="newCategoryForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="country">Naziv:</label>
				    <div class="controls">
				      <input type="text" id="name" name="name" placeholder="Naziv kategorije" class="validate[required]" />
				    </div>
				  </div>
				</form>
			</div>
			<div class="modal-footer">  
				<a id="addNewCategory" class="btn btn-success">Sačuvaj</a>  
				<a  class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="addOrganizerModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Dodavanje organizatora</h3>
			</div>

			<div class="modal-body">
				<form id="addNewOrganizerForm" name="newOrganizerForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="pib">PIB:</label>
				    <div class="controls">
				      <input type="text" id="pib" name="pib" placeholder="PIB organizatora" class="validate[required]" />
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="name">Naziv:</label>
				    <div class="controls">
				      <input type="text" id="name" name="name" placeholder="Naziv organizatora" class="validate[required]" />
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="email">E-mail:</label>
				    <div class="controls">
				      <input type="text" id="email" name="email" placeholder="Email organizatora" class="validate[required]" />
				    </div>
				  </div>
				</form>
			</div>
			<div class="modal-footer">  
				<a id="addNewOrganizer" class="btn btn-success">Sačuvaj</a>  
				<a  class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="addDestinationModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Dodavanje nove destinacije</h3>
			</div>

			<div class="modal-body">
				<form id="addNewDestinationForm" name="newDestinationForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="country">Zemlja:</label>
				    <div class="controls">
				      <input type="text" id="country" name="country" placeholder="Zemlja" class="validate[required]" />
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="town">Grad:</label>
				    <div class="controls">
				      <input type="text" id="town" name="town" placeholder="Grad" class="validate[required]" />
				    </div>
				  </div>
				</form>
			</div>
			<div class="modal-footer">  
				<a id="addNewDestination" class="btn btn-success">Sačuvaj</a>  
				<a  class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="addAccomodationModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Dodavanje novog smeštaja</h3>
			</div>
	
			<div class="modal-body">
				<form id="addNewAccomodationForm" name="newAccomodationForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="type">Tip smeštaja:</label>
				    <div class="controls">
				    	<input type="text" name='type' id='typeModNew' placeholder="Tip smeštaja" class='form-control'/>
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
				    	<select name='destination_id' id='destinationAcc' placeholder="Destinacija" class='form-control'></select>
				    </div>
				  </div>
				  <div class="control-group" id="units">
				  	<a href="#" id="addUnit" class="btn">Dodaj smeštajnu jedinicu</a>
				  </div>
				</form>
			</div>
		
			<div class="modal-footer">  
				<a id="addNewAccomodation" class="btn btn-success">Sačuvaj</a>  
				<a  id="closeNewAccModal" class="btn" data-dismiss="modal">Odustani</a>  		
			</div>
		</div>
	</div> 
</div>

<div id="unitsId" class="hiddenUnit">
	<div class="form-inline">
		<fieldset>
			<legend>Smestajna jedinica</legend>
		    	<input type="text" id="nameUnitModNew" class="input-large input-size" placeholder="Tip jedinice">
		      <input type="text" id="capacityUnitModNew" class="input-large input-size" placeholder="Broj kreveta">
		      <input type="text" id="numberUnitModNew" class="input-large input-size" placeholder="Broj jedinica">
		      <a href="#" id="removeUnit" class="pull-right"><span class="icon icon-remove-sign"></span></a>
		</fieldset>
	</div>
</div>

@stop