@extends('home')

@section('content')
{{HTML::script('scripts/reservations.js')}}

<style type="text/css">
	#paymentModal{
		display: none;
	}
</style>

<div class="container">
<div class="row">
<div class="span8">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="reservations">Rezervacije</a></li>
	    </ul>
	</nav>
	</div>
	
	</div>
</div>

@include('notifications')
<br>
<div class="container" id="reservations">
<div class="row">
		<div>
			<select name='res_search_item' id='res_filter' placeholder="Unesite broj rezervacije ili JMBG putnika ili ime ili prezime putnika" class='form-control'></select>
		</div>
		<div>
			<span class="pull-right"> <a role="button" class="btn btn-default btn-small" id="bresetRes">Resetuj pretragu</a></span>
			<span class="pull-right">
			<a role="button"  class="btn btn-small btn-default pull-right" href="#" id="newReservation">Nova rezervacija</a>
			</span>
		</div>
	</div>
	

	<div class="row">
		<div id="reservationsPartial">
			{{$reservationsPartial}}
		</div>
	</div>
</div>

<div class="container" id="paymentModal">
	<div class="row">
		<div id="paymentNewModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3 style="float:left">Novo Plaćanje</h3>
				<select class="validate[required]" name="type_of_payment" id="type_of_payment" style="margin-left:30pt; margin-top:5pt;">
					<option value="0" selected="selected">Aranžman</option>
					<option value="1">Izlet</option>
				</select>
			</div>
			<div id="payment-form">
				{{ Form::open(array('url' => 'storePayment', 'name' => 'addNewPaymentForm', 'id' => 'addNewPaymentForm' )) }}
				<div class="modal-body">
					<table class="table">
						<col width="120">
						<col width="80">
						<col width="150">
						<col width="150">
						<tr class="payment-table-prices">
							<td colspan="2"><div class="input-control text" align="right">Ostalo za uplatu -></div></td>
							<td>
								<div class="input-control text" align="right" id="left_to_pay_din" style="color:red"></div>
							</td>
							<td>
								<div class="input-control text" align="right" id="left_to_pay_eur" style="color:red"></div>
							</td>
						</tr>
						<tr class="payment-table-data payment-table-prices">
							<td colspan="2"><div class="input-control text" align="right">Ostalo za uplatu pojedinačno -></div></td>
							<td>
								<div class="input-control text" align="right" id="psg_left_to_pay_din" style="color:red"></div>
							</td>
							<td>
								<div class="input-control text" align="right" id="psg_left_to_pay_eur" style="color:red"></div>
							</td>
						</tr>
						<tr>
							<td colspan='1'>
								<div class="input-control text">
									<select class="validate[required]" name="payment_type" id="payment_type" style="width:120px">
										<option value="" disabled selected="selected" style='display:none;'>Sredstvo plaćanja</option>
										<option value="kes">Keš</option>
										<option value="kartica">Kartica</option>
										<option value="cek">Ček</option>
										<option value="virman">Virman</option>
										<option value="interno">Interno</option>
									</select>
									<input type="text" name="card_type" id="card_type" placeholder="Tip kartice" style="width:120px" />
								</div>
							</td>
							<td colspan='2'>
								<div class="input-control text">
									<select class="validate[required]" name="passanger_search" style="width:100%" id="passanger_search">
										<option value="" disabled selected="selected" style='display:none;'>Uplatilac</option>
									</select>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="reservation_number" id="reservation_number" placeholder="Br. rezervacije"/>
									<input type="hidden" class="validate[required]" name="reservation_id" id="reservation_id"/>
								</div>
							</td>
						</tr>
						<tr rowspan="2" class="payment-table-data">
							<td colspan='1'>
								<div class="input-control text input-append date" id="res_datepicker">
									<input type="text" id="res_date" class="validate[required]" name="res_date" placeholder="Datum plaćanja"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="hidden" id="session_exchange_rate" value="{{ Session::get('exchRate') }}"/>
									<!-- {{Form::text('exchange_rate', Session::get('exchRate'), array('id' => 'exchange_rate', 'value' => Session::get('exchRate')))}} -->
									<input type="text" class="validate[required]" name="exchange_rate" id="exchange_rate" value="{{ Session::get('exchRate') }}"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="amount_din" id="amount_din" placeholder="Dinarski deo (din)"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="amount_eur_din" id="amount_eur_din" placeholder="Devizni deo (din)"/>
								</div>
								<div class="input-control text">
									<input type="text" name="amount_eur_eur" id="amount_eur_eur" placeholder="Devizni deo (€)" tabindex="-1"/>
								</div>
							</td>
						</tr>
						<tr class="payment-table-data">
							<td colspan='1' rowspan='2'>
								<div class="input-control text">
									<textarea rows='2' style="width:100%" name="	payment_method" id="payment_method" placeholder="Metod plaćanja"></textarea>
								</div>
							</td>
							<td colspan='2' rowspan='2'>
								<div class="input-control text">
									<textarea rows='2' style="width:100%" name="description" id="description" placeholder="Opis"></textarea>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" class="validate[required]" name="fiscal_slip" id="fiscal_slip" placeholder="Br. Fisk. isečka"/>
								</div>
							</td>
						</tr>
					</table>
				</div>

				<div class="modal-footer">  
					<a id="storeNewPayment" class="btn btn-success">Sačuvaj</button>
					<a class="btn btn-cancel" data-dismiss="modal">Odustani</a>  	
				</div> 
				{{ Form::close() }}
			</div>
			<div id="excursion-form">
				{{ Form::open(array('url' => 'storeExcursionPayment', 'name' => 'addNewExcursionPaymentForm', 'id' => 'addNewExcursionPaymentForm' )) }}
				<div class="modal-body">
					<table class="table">
						<col width="120">
						<col width="80">
						<col width="150">
						<col width="150">
						<tr class="payment-table-prices">
							<td colspan="2"><div class="input-control text" align="right">Ostalo za uplatu -></div></td>
							<td>
								<div class="input-control text" align="right" id="left_to_pay_din_i" style="color:red"></div>
							</td>
							<td>
								<div class="input-control text" align="right" id="left_to_pay_eur_i" style="color:red"></div>
							</td>
						</tr>
						<tr class="payment-table-data-i payment-table-prices">
							<td colspan="2"><div class="input-control text" align="right">Ostalo za uplatu pojedinačno -></div></td>
							<td>
								<div class="input-control text" align="right" id="psg_left_to_pay_din_i" style="color:red"></div>
							</td>
							<td>
								<div class="input-control text" align="right" id="psg_left_to_pay_eur_i" style="color:red"></div>
							</td>
						</tr>
						<tr>
							<td colspan='1'>
								<div class="input-control text">
								</div>
							</td>
							<td colspan='2'>
								<div class="input-control text">
									<select class="validate[required]" name="passanger_search" style="width:100%" id="passanger_search_i">
										<option value="" disabled selected="selected" style='display:none;'>Uplatilac</option>
									</select>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="reservation_number" id="reservation_number_i" placeholder="Br. rezervacije"/>
									<input type="hidden" class="validate[required]" name="reservation_id" id="reservation_id_i"/>
								</div>
							</td>
						</tr>
						<tr rowspan="2" class="payment-table-data-i">
							<td colspan='1'>
								<div class="input-control text input-append date" id="res_datepicker_i">
									<input type="text" id="res_date_i" class="validate[required]" name="res_date" placeholder="Datum plaćanja"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" class="validate[required]" name="exchange_rate" id="exchange_rate_i" value="{{ Session::get('exchRate') }}"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="amount_din" id="amount_din_i" placeholder="Dinarski deo (din)"/>
								</div>
							</td>
							<td colspan='1'>
								<div class="input-control text">
									<input type="text" name="amount_eur_din" id="amount_eur_din_i" placeholder="Devizni deo (din)"/>
								</div>
								<div class="input-control text">
									<input type="text" name="amount_eur_eur" id="amount_eur_eur_i" placeholder="Devizni deo (€)" tabindex="-1"/>
								</div>
							</td>
						</tr>
						<tr class="payment-table-data-i">
							<td colspan='4' rowspan='2'>
								<div class="input-control text">
									<textarea rows='2' style="width:100%" name="description" id="description_i" placeholder="Opis"></textarea>
								</div>
							</td>
						</tr>
					</table>
				</div>

				<div class="modal-footer">  
					<a id="storeNewExcursionPayment" class="btn btn-success">Sačuvaj</button>
					<a class="btn btn-cancel" data-dismiss="modal">Odustani</a>  	
				</div> 
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop