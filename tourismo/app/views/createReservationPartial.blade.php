{{HTML::script('scripts/reservationsCreate.js')}}
<style type="text/css">
	#psgMessage, #paymentItem, #unitsId, #traveldealNew, #traveldealDetails, .hiddenPsgItems{
		display:none;
	}

	#passangers_details, #payment_details, #details{
	display: none;
	}

	#createReservationBtn{
		display:none;
	}

	.modal{
		overflow-y:auto;
		z-index: 100000; 
	}

	#paymentModal{
		display: none;
	}

	#psgName{
		font-size: 14px;
		font-weight: bolder;
	}
	
</style>
<script>
	window.onbeforeunload = function(e){
		return "Ukoliko napustite stranicu izgubićete sve unete podatke.";
	}
</script>
@include('notifications')

<div class="row">
	<div class="span4">Datum rezervacije: {{date("d/m/Y")}}</div>
	<div class="span4">Broj rezervacije: <input type="text" name="reservationNumber" id="resNum" placeholder="Unesite broj rezervacije" /></div>
	<div class="span4"><div class="pull-right"><input type="checkbox" name="internal" id="internal">Interna </div></div>
</div>

<div class="row">
		<div class="span12">
			<fieldset>
				<legend>1. Detalji aranžmana</legend>
				<div class="container">
					<div class="row">
						<div class="span12">						
							<select name='traveldeals' id='traveldealsSel' placeholder="Aranžman" class='form-control'></select>
							<a href="#" class="btn btn-small btn-default pull-right" id="addTravelDeal">Dodaj novi aranžman</a>
						</div>
					</div>

					<div id="traveldealDetails" class="row">
						<div class="span12">
							<div class="container">
								<div class="row">	
										<div class="span4"><label>Kategorija aranžmana:</label><input type="text" id="category" name="category"/></div>
										<div class="span4"><label>Organizator aranžmana:</label><input type="text" id="organizer" name="organizer"/></div>
										<div class="span4"><label>Destinacija:</label><input type="text" id="destination" name="destination"/></div>
								</div>
								<div class="row">						
										<div class="span4"><label>Smeštaj:</label><input type="text" id="accomodation" name="accomodation"/></div>
										<div class="span4"><label>Prevoz:</label><input type="text" id="transportation" name="transportation"/></div>
										<div class="span4"><label>Usluga:</label><input type="text" id="service" name="service"/>
												
										</div>
								</div>
							</div>
						</div>
					</div>

					<div id="traveldealNew" class="row">
						<div class="span12">
							<div class="container">
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
														<input type="text" name='priceDin' id='priceDinSel' value="0" class='form-control' />
													</div>
												<div class="span4">
														<label>Cena (eur):</label>
														<input type="text" name="priceEur" id="priceEurSel" value="0"/>
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
				</div>
			</fieldset>
		</div>
</div>

<div class="row" id="passangers_details">
		<div class="span12">
			<fieldset>
				
				<legend>2. Detalji putnika</legend>
				<div class="conatiner">
					<div class="row">
						<div class="span12">						
							<select name='passangers' id='passangersSel' placeholder="Putnici" class='form-control'></select>
							<a href="#" class="btn btn-small btn-default pull-right" id="addNewPsg">Dodaj novog putnika</a>
						</div>
					</div>
					
					<div class="row">
						<div class="span12">
							<form id="passangersDetailsForm" id="passangersDetailsForm">
								<div class="span12 pull-left" id="passangersDetails"></div>
							</form>
							<div id="psgMessage">
								<div class="alert alert-danger alert-dismissable">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								  <strong>Izaberite putnike za rezervaciju!</strong>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="passangerNew">
						<div class="span12">
							<form id="passangerNewForm" name="passangerNewForm" autocomplete="off">
<!--								<div class="container">-->
									<div>
											<div class="span3 input-control text">
												<input type="text" name="name" id="name" class="validate[required]" placeholder="Ime"/>
											</div>
											<div class="span3 input-control text">
												<input type="text" name="surname" id="surname" class="validate[required]" placeholder="Prezime"/>
											</div>
											<div class="span3 input-control text">
												<input type="text" name="address" id="address" class="validate[required]" placeholder="Adresa"/>
											</div>
											<div class="span3 input-control text select">
												<select class="span2" name="gender" id="gender">
													<option value="" disabled selected="selected" style='display:none;'>Pol...</option>
													<option value="m">m</option>
													<option value="f">ž</option>
												</select>
											</div>
									</div>
									<div>
											<div class="span3 input-control text">
												<input type="text" name="tel" id="tel" placeholder="Telefon"/>
											</div>
											<div class="span3 input-control text">
												<input type="text" name="mob" id="mob" placeholder="Mobilni"/>
											</div>
											<div class="span3 input-control text">
												<input type="text" name="jmbg"  class="validate[required]" id="jmbg" placeholder="JMBG"/>
											 </div>
											<div class="span3 input-control text">
												<input type="text" name="passport" id="passport" placeholder="Broj Pasoša"/>
											</div>
									</div>
									<div>
										<div class="span3" id="birth_datepicker">
											<input type="text" class="span2" style="height:100%" id="birth_date" name="birth_date" placeholder="d-m-yy" autocomplete="off"/>
											<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
										</div>
										<div class="span2">
											<span class="btn btn-default" id="btnAddNewPsg">Dodaj</span>
										</div>
									</div>
<!--								</div>-->
							</form>
						</div>
					</div>
				</div>
			</fieldset>
	</div>
</div>

<div class="row" id="payment_details">
	<div class="span12">
		<fieldset>
			<legend>3. Detalji plaćanja</legend>
			<div class="container">
				<div class="row">
					<div class="span12" id="psgPaymentDetails">

					</div>
				</div>
				<div class="row">
					<div class="span12">
						<a href="#" class="btn btn-default  pull-right" id="addPaymentItem">Dodaj plaćanje</a>
					</div>
				</div>
				<div class="row">
						<div class="span12 psgPayment finalPayment">
							<table>
								<tr>
									<th class="medium-width">Obračun</th>
									<th class="medium-width">Po osobi (eur)</th>
									<th class="medium-width">Po osobi (din)</th>
									<th class="medium-width">Broj osoba</th>
									<th class="medium-width">Iznos (din)</th>
									<th class="medium-width">Iznos (eur)</th>
									<th class="">Izlet</th>
									<th class=""></th>
								</tr>	
							</table>	
							<form name="paymentDetailsForm" id="paymentDetailsForm">				
								<div id="paymentItems"></div>
							</form>

							<table>
								<tr>
									<td class="wide600 pull-right"><span class="pull-right">Ukupno:</span></td>
									<td class="medium-width"> (DIN)<input type="text" name="TotalDIN" id="totalDIN" class="input-medium" readonly /></td>
									<td class="medium-width">(EUR)<input type="text" name="TotalEUR" id="totalEUR" class="input-medium" readonly /></td>
									<td class=""></td>
									<td class=""></td>
								</tr>
							</table>
						</div>			
				</div>
				<div class="row">
					<div class="span12">						
						<div id="passangers"></div>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>

<div class="row" id="details">
	<div class="span12">
		<fieldset>
			<legend>4. Detalji</legend>
			<form name="createReservationForm" id="createReservationForm" autocomplete="off">
				<input type="hidden" id="traveldealId" name="traveldealId" />
				<div class="container">
					<div class="row">						
						<div class="span3">
							<div class="input-control text input-append date" id="start_datepicker">
							<input type="text" style="height:100%" class="validate[required]" id="start_date" name="start_date" placeholder="Početak usluge d-m-yy">
							<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
							</div>
						</div>
						<div class="span3">
							<div class="input-control text input-append date" id="end_datepicker">
							<input type="text" style="height:100%" class="validate[required]" id="end_date" name="end_date" placeholder="Kraj usluge d-m-yy">
							<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
						</div>
						</div>
						<div class="span3">
							<div class="input-control text input-append date" id="travel_datepicker">
							<input type="text" style="height:100%" class="validate[required]" id="travel_date" name="travel_date" placeholder="Datum polaska d-m-yy">
							<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
						</div>
						</div>
						<div class="span3">
							<input type="text" name="numnights" id="numnights" placeholder="Broj noćenja" class="validate[required]"/>
						</div>
					</div>

					<div class="row">
							<div class="span4">
								<input type="text" style="height:100%" id="discount" name="discount" placeholder="Popust"/>
							</div>
							<div class="span4">
								<input type="text" style="height:100%" id="discounter" name="discounter" placeholder="Popust odobrio"/>
							</div>
							<div class="span4">
								<input type="text" style="height:100%" id="clockindex" name="clockindex" placeholder="Clock Index"/>
							</div>
					</div>

					<div class="row">
						<div class="span6">
							<textarea rows="5" id="notes" name="notes" placeholder="Napomene"></textarea>
						</div>
						<div class="span6">
							<textarea rows="5" cols="50" id="internalnotes" name="internalnotes" placeholder="Interne napomene"></textarea>
						</div>
					</div>

				</div>
			</form>
		</fieldset>
	</div>
</div>

<div class="row" >
	<div class="span12">
		<button id="createReservationBtn" class="btn btn-primary pull-right">Kreiraj rezervaciju</button>
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
		    	<input type="text" name='type' id='typeModNew' placeholder="Hotel/Vila/Hostel/..." class='form-control'/>
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
		    	<input type="text" id="nameUnitModNew" class="input-large input-size" placeholder="STD/APP/Soba/...">
		      <input type="text" id="capacityUnitModNew" class="input-large input-size" placeholder="Broj kreveta">
		      <input type="text" id="numberUnitModNew" class="input-large input-size" placeholder="Broj jedinica">
		      <a href="#" id="removeUnit" class="pull-right"><span class="icon icon-remove-sign"></span></a>
		</fieldset>
	</div>
</div>

<div id="paymentItem" class="hiddenItem">
	<div class="form-inline">
		      <input type="text" id="paymentItemName" class="input-medium nameItem" placeholder="" />
		      <input type="text" id="paymentItemEuro" class="input-medium euroItem" value="0" placeholder="" />
		      <input type="text" id="paymentItemDin" class="input-medium dinItem" value="0" placeholder="" />
		      <input type="text" id="paymentItemNum" class="input-medium numItem" value="0" placeholder="" />
		      <input type="text" id="paymentItemTotalDin" class="input-medium" value="0" placeholder="" />
		      <input type="text" id="paymentItemTotalEuro" class="input-medium" value="0" placeholder="" />
		      <input type="checkbox" id="isExcursion">
		      <input type="hidden" id="paymentItemPsgId" />
		      <a href="#" id="removeItem" class="pull-right"><span class="icon icon-remove-sign"></span></a>
  </div>
</div>

<div class="hiddenPsgItems">
	<div id="psgName"></div>
	<br>
	<a href="#" class="btn btn-default pull-right" id="addPsgPaymentItem">Dodaj plaćanje</a>
	<br>
<table>
	<tr>
		<th colspan="8"></th>
	</tr>
	<tr>
		<th class="medium-width">Obračun</th>
		<th class="medium-width">Po osobi (eur)</th>
		<th class="medium-width">Po osobi (din)</th>
		<th class="medium-width">Broj osoba</th>
		<th class="medium-width">Iznos (din)</th>
		<th class="medium-width">Iznos (eur)</th>
		<th class="">Izlet</th>
		<th class=""></th>
	</tr>	
</table>	
<form name="paymentDetailsForm" id="paymentDetailsForm">				
	<div id="paymentItems"></div>
</form>

<table>
	<tr>
		<td class="wide600 pull-right"><span class="pull-right">Ukupno:</span></td>
		<td class="medium-width"> (DIN)<input type="text" id="totalDIN" class="input-medium" readonly /></td>
		<td class="medium-width">(EUR)<input type="text" id="totalEUR" class="input-medium" readonly /></td>
		<td class=""></td>
		<td class=""></td>
	</tr>
</table>
</div>
