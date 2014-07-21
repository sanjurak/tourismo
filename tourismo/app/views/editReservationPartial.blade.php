{{HTML::script('scripts/editReservations.js')}}

<script>
	window.onbeforeunload = function(e){
		return "Ukoliko napustite stranicu izgubićete sve unete podatke.";
	}
</script>
<style type="text/css">
	#payMessage, #psgMessage, .hiddenItem, #unitsId{
		display:none;
	}
	#paymentModal{
		display: none;
	}
	
	textarea{
		width:auto;
	}
	
	.psgDeleted{
		text-decoration:line-through;
	}
	
	.undo-psg, .undo-pay{
		display:none;
	}
	
	.payDeleted input{
		disabled: true;
	}
	
</style>
<div class="row">
	<div class="span12">
	<form id="generalInfo" name="reservationGeneralInfo">
		Broj rezervacije: <input type="text" name="reservation_number" id="resNum" value={{$reservation->reservation_number}} class="validate[required]" />
		</form>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div>						
			<select name='traveldeals' id='traveldealsSel' placeholder="Izaberite novi aranžman" class='form-control'></select>
		</div>
	</div>
</div>

<div id="traveldealDetails" class="row">
	<div class="span12">
		<div class="container">
			<div class="row">	
					<div class="span4"><label>Kategorija aranžmana:</label><input type="text" id="category" name="category" value="{{$reservation->traveldeal->category->name}}" disabled/></div>
					<div class="span4"><label>Organizator aranžmana:</label><input type="text" id="organizer" name="organizer" value="{{$reservation->traveldeal->organizer->name}}" disabled/></div>
					<div class="span4"><label>Destinacija:</label><input type="text" id="destination" name="destination" value="{{$reservation->traveldeal->destination->name}}" disabled/></div>
			</div>
			<div class="row">						
					<div class="span4"><label>Smeštaj:</label><input type="text" id="accomodation" name="accomodation" value="{{$accunit->accomodation->type . " " . $accunit->accomodation->name . ", ". $accunit->name . "/" . $accunit->capacity}}" disabled/></div>
					<div class="span4"><label>Prevoz:</label><input type="text" id="transportation" name="transportation" value="{{$reservation->traveldeal->transportation}}" disabled/></div>
					<div class="span4"><label>Usluga:</label><input type="text" id="service" name="service" value="{{$reservation->traveldeal->service}}" disabled/>
							
					</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12">						
		<select name='passangers' id='passangersSel' placeholder="Dodajte putnika" class='form-control'></select>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div id="psgMessage">
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Izaberite putnike za rezervaciju!</strong>
			</div>
		</div>
		<div>
			<form id="passangersDetailsForm" name="passangersDetailsForm">
				<div class="span10 pull-left" id="passangersDetails">
				@foreach($passangers as $ind => $passanger)
					<div class="psg-item">
						{{$passanger->name ." ". $passanger->surname .",JMBG:  ".$passanger->jmbg ." Pasoš: ". $passanger->passport}}
						<input type="hidden" id="psgId" name="OldPassangers[{{$ind}}][id]" class="passangers" value="{{$passanger->id}}" />
						<input type="hidden" id="psgDelete" name="OldPassangers[{{$ind}}][delete]" value="0" />
						<a href='#' class='delete-psg pull-right'><span class='icon icon-remove-sign'></span></a>
						<a href='#' class='undo-psg pull-right'><span class='icon icon-repeat'></span></a>
					</div>	
				@endforeach
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row" id="payment_details">
	<div class="span12">
		<div class="container">
			<div class="row">
				<div class="span12">
					<a href="#" class="btn btn-default  pull-right" id="addPaymentItem">Dodaj plaćanje</a>
				</div>
			</div>
			<div class="row">
				<div class="span12">
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
					<div id="payMessage">
						<div class="alert alert-danger alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>Unesite najmanje jedno plaćanje!</strong>
						</div>
					</div>
					<div>	
					<form name="paymentDetailsForm" id="paymentDetailsForm">				
						<div id="paymentItems">
						@foreach($resPrices as $ind => $price)
							<div id="paymentItem" class="paymentItem">
							 <div class="form-inline">
							      <input type="text" id="paymentItemName" class="input-medium validate[required]" name="Prices[{{$ind}}][name]" value="{{$price->priceItem}}" />
							      <input type="text" id="paymentItemEuro" class="input-medium euroItem validate[required]" name="Prices[{{$ind}}][priceEur]" value="{{$price->priceEur}}" />
							      <input type="text" id="paymentItemDin" class="input-medium dinItem validate[required]" name="Prices[{{$ind}}][priceDin]" value="{{$price->priceDin}}" />
							      <input type="text" id="paymentItemNum" class="input-medium numItem validate[required]" name="Prices[{{$ind}}][num]" value="{{$price->num}}" >
							      <input type="text" id="paymentItemTotalDin" class="input-medium validate[required]" />
							      <input type="text" id="paymentItemTotalEuro" class="input-medium validate[required]" />
							      <input type="checkbox" id="isExcursion" />
							      <input type="hidden" id="PriceId" name="Prices[{{$ind}}][id]" value={{$price->id}} />
							      <input type="hidden" id="PriceDelete" name="Prices[{{$ind}}][delete]" value="0" />
							      <a href="#" id="deleteItem" class="delete-pay pull-right"><span class="icon icon-remove-sign"></span></a>
							     <a href='#' id="undoItem" class="undo-pay pull-right"><span class='icon icon-repeat'></span></a>
							  </div>
							</div>
						
						@endforeach
						</div>
					</form>
					</div>

					<table>
						<tr>
							<td class="wide600 pull-right"><span class="pull-right">Ukupno:</span></td>
							<td class="medium-width"> (DIN)<input type="text" name="totalDIN" id="totalDIN" class="input-medium" readonly /></td>
							<td class="medium-width">(EUR)<input type="text" name="totalEUR" id="totalEUR" class="input-medium" readonly /></td>
							<td class=""></td>
							<td class=""></td>
						</tr>
					</table>
				</div>			
			</div>
		</div>
	</div>
</div>

<div class="row">
<div class="span12">

		<input type="hidden" id="reservationId" name="reservationId" value={{$reservation->id}} />
	<form name="editReservationForm" id="editReservationForm">
		<input type="hidden" id="traveldealId" name="traveldeal_id" value={{$reservation->traveldeal->id}} />
		<div class="container">
		<div class="row">						
			<div class="span3">
				<div class="input-control text input-append date" id="start_datepicker">
				Početak usluge:<br> <input type="text" style="height:100%" class="validate[required]" id="start_date" name="start_date" value="{{date('d-m-Y', strtotime($reservation->start_date))}}" placeholder="Početak usluge"/>
				<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
				</div>
			</div>
			<div class="span3">
				<div class="input-control text input-append date" id="end_datepicker">
					Kraj usluge:<br> <input type="text" style="height:100%" class="validate[required]" id="end_date" name="end_date" value="{{date('d-m-Y', strtotime($reservation->end_date))}}" placeholder="Kraj usluge"/>
					<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
				</div>
			</div>
			<div class="span3">
				<div class="input-control text input-append date" id="travel_datepicker">
				Datum polaska:<br> <input type="text" style="height:100%" class="validate[required]" id="travel_date" name="travel_date" value="{{date('d-m-Y', strtotime($reservation->travel_date))}}" placeholder="Datum polaska"/>
				<span class="add-on" style="height:100%"><i class="icon-calendar"></i></span>
			</div>
			</div>
			<div class="span3">
				Broj noći: <br> <input type="text" name="nights_num" id="numnights" value={{$reservation->nights_num}}  placeholder="Broj noćenja" class="validate[required]"/>
			</div>
		</div>

		<div class="row">
				<div class="span4">
					Popust:<br> <input type="text" style="height:100%" id="discount" value={{$reservation->discount}} name="discount" placeholder="Popust"/>
				</div>
				<div class="span4">
					Popust odobrio:<br> <input type="text" style="height:100%" id="discounter" name="discounter_name" value="{{$reservation->discounter_name}}" placeholder="Popust odobrio"/>
				</div>
				<div class="span4">
					Clock Index:<br> <input type="text" style="height:100%" id="clockindex" name="clock_index" value={{$reservation->clock_index}}  placeholder="Clock Index"/>
				</div>
		</div>

		<div class="row">
			<div class="span6">
				Napomena:<br> <textarea rows="10" cols="80" id="notes" name="note" value="" placeholder="Napomene">{{$reservation->note}}</textarea>
				</div>
				<div class="span6">
				Interna napomena:<br> <textarea rows="10" cols="80" id="internalnotes" name="note_internal" value=""  placeholder="Interne napomene">{{$reservation->note_internal}}</textarea>
			</div>
		</div>

	</div>
</form>
</div>
</div>

<div class="row" >
	<div class="span12">
	<div class="pull-right">
		<a href="#" id="editReservationBtn" class="btn btn-primary">Ažuriraj rezervaciju</a>
		<a href="reservations" id="cancelEditReservationBtn" class="btn btn-alert">Odustani</a>
		</div>
	</div>
</div>

<div id="paymentItem" class="hiddenItem">
	<div class="form-inline">
		      <input type="text" id="paymentItemName" class="input-medium" placeholder="">
		      <input type="text" id="paymentItemEuro" class="input-medium euroItem" placeholder="">
		      <input type="text" id="paymentItemDin" class="input-medium dinItem" placeholder="">
		      <input type="text" id="paymentItemNum" class="input-medium numItem" value="1" placeholder="">
		      <input type="text" id="paymentItemTotalDin" class="input-medium" placeholder="">
		      <input type="text" id="paymentItemTotalEuro" class="input-medium" placeholder="">
		      <input type="checkbox" id="isExcursion">
		      <a href="#" id="removeItem" class="pull-right"><span class="icon icon-remove-sign"></span></a>
  </div>
</div>