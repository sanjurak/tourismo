{{HTML::script('scripts/reservationsCreate.js')}}
<style type="text/css">
	#unitsId, #traveldealNew, #traveldealDetails{
		display:none;
	}
</style>

<div class="row">

	<div class="span12">Datum rezervacije: {{date("d/m/Y")}}</div>

	<div class="span12">
		<div class="container">
		<fieldset>
			<legend>Detalji aranžmana</legend>
			<div class="container">
				<div class="row">
					<div class="container">
						<div class="span12 pull-left">						
							<select name='traveldeals' id='traveldealsSel' placeholder="Aranžman" class='form-control'></select>
							<a href="#" class="btn btn-small btn-default pull-right" id="addTravelDeal">Dodaj novi aranžman</a>
						</div>
					</div>
				</div>

				<div id="traveldealDetails" class="row">
					<div class="container">
						<div class="row">	
							<div class="span4"><label>Kategorija aranžmana:</label><input type="text" id="category"/></div>
							<div class="span4"><label>Organizator aranžmana:</label><input type="text" id="organizer"/></div>
							<div class="span4"><label>Destinacija:</label><input type="text" id="destination"/></div>
						</div>
						<div class="row">							
							<div class="span4"><label>Smeštaj:</label><input type="text" id="accomodation"/></div>
							<div class="span4"><label>Prevoz:</label><input type="text" id="transportation"/></div>
							<div class="span4"><label>Usluga:</label><input type="text" id="service"/></div>
						</div>
					</div>
				</div>

				<div id="traveldealNew" class="row">
					<div class="container">
						<div class="row">
							<div class="container">
								<div class="span12">
									<a role="button" class="btn btn-small btn-alert" href="#" id="addCategoryBtn">Dodaj kategoriju</a>
			
									<a role="button" class="btn btn-small btn-alert" href="#" id="addDestinationBtn">Dodaj destinaciju</a>
								
									<a role="button" class="btn btn-small btn-alert" href="#" id="addOrganizerBtn">Dodaj organizatora</a>
								
									<a role="button" class="btn btn-small btn-alert" href="#" id="addAccomodationBtn">Dodaj smeštaj</a>
								</div>
							</div>
						</div>
						<form id="traveldealNewForm" name="traveldealNewForm">
							<div class="row">
								<div class="container">	
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
							</div>
							<div class="row">	
								<div class="container">						
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
							</div>
							<div class="row">	
								<div class="container">						
									<div class="span4">
											<label>Cena (din):</label>
											<input type="text" name='priceDin' id='priceDinSel' placeholder="Cena u dinarima" class='form-control' />
										</div>
									<div class="span4">
											<label>Cena (eur):</label>
											<input type="text" name="priceEur" id="priceEurSel" placeholder="Cena u eurima"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="container">
									<div class="span12">
										<span class="btn btn-default" id="btnAddTravelDeal">Dodaj</span>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
		</div>
		</fieldset>
	</div>
</div>


<div class="span12">
	<div class="container">
		<fieldset>
			<legend>Detalji putnika</legend>
			<div class="container">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="span10">						
								<select name='passangeres' id='passangersSel' placeholder="Putnici" class='form-control'></select>
							</div>	
							<div class="span2 pull-left">						
								<a href="#" class="btn btn-small btn-default pull-right" id="addTravelDeal">Dodaj novog putnika</a>
							</div>							
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="container">
						<div class="span12">						
							<div id="passangers"></div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
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
		    	<input type="text" id="nameUnitModNew" class="input-large input-size validate[required]" placeholder="Tip jedinice">
		      <input type="text" id="capacityUnitModNew" class="input-large input-size validate[required]" placeholder="Broj kreveta">
		      <input type="text" id="numberUnitModNew" class="input-large input-size validate[required]" placeholder="Broj jedinica">
		      <a href="#" id="removeUnit" class="pull-right"><span class="icon icon-remove-sign"></span></a>
		</fieldset>

		  </div>
</div>
