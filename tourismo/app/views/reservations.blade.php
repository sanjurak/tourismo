@extends('home')

@section('content')

<style type="text/css">
	#paymentModal{
		visibility: visible;
	}
</style>

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Rezervacije</a></li>
	    </ul>
	</nav>
</div>

@include('notifications')

<div class="container" id="reservations">
	<div class="row">
		<a class="btn btn-default pull-right" href="#" id="newReservation">Nova rezervacija</a>
	</div>

	<div class="row">
		<div id="reservationsPartial">
			{{$reservationsPartial}}
		</div>
	</div>
</div>

<div class="container" id="paymentModal">
	<div class="row">
		<div id="paymentNewModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Novo Plaćanje</h3>
			</div>
			{{ Form::open(array('url' => 'storePayment', 'name' => 'addNewPaymentForm', 'id' => 'addNewPaymentForm' )) }}
			<div class="modal-body">
			</br>
				<table class="table">
					<tr>
						<td colspan='1'>
							<div class="input-control text">
								<select class="validate[required]" name="payment_type" id="payment_type" style="width:120px">
									<option value="" disabled selected="selected" style='display:none;'>Sredstvo plaćanja</option>
									<option value="kes">Keš</option>
									<option value="kartica">Kartica</option>
									<option value="cek">Ček</option>
									<option value="virman">Virman</option>
								</select>
								<input type="text" name="card_type" id="card_type" placeholder="Tip kartice" style="width:120px" />
							</div>
						</td>
						<td colspan='3'>
							<div class="input-control text">
								<select class="validate[required]" name="passanger_search" style="width:100%" id="passanger_search">
									<option value="" disabled selected="selected" style='display:none;'>Uplatilac</option>
								</select>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" name="reservation_number" id="reservation_number" placeholder="Br. rezervacije"/>
								<input type="hidden" class="validate[required]" name="reservation_id" id="reservation_id"/>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-control text input-append date" id="birth_datepicker">
								<input type="text" id="res_date" class="validate[required]" name="res_date" placeholder="Datum plaćanja"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<!-- {{Form::text('exchange_rate', Session::get('exchRate'), array('id' => 'exchange_rate', 'value' => Session::get('exchRate')))}} -->
								<input type="text" class="validate[required]" name="exchange_rate" id="exchange_rate" value="{{ Session::get('exchRate') }}"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" name="amount_din" id="amount_din" placeholder="Dinarski deo"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" name="amount_eur_din" id="amount_eur_din" placeholder="Devizni deo (€)"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" class="validate[required]" name="fiscal_slip" id="fiscal_slip" placeholder="Br. Fisk. isečka"/>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='2' rowspan='2'>
							<div class="input-control text">
								<textarea rows='2' style="width:100%" name="	payment_method" id="payment_method" placeholder="Metod plaćanja"></textarea>
							</div>
						</td>
						<td colspan='3' rowspan='2'>
							<div class="input-control text">
								<textarea rows='2' style="width:100%" name="description" id="description" placeholder="Opis"></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="modal-footer">  
				<a id="storeNewPayment" class="btn btn-success" data-dismiss="modal">Sačuvaj</button>
				<a class="btn btn-cancel" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop