@extends('home')
@section('content')
{{HTML::script('scripts/payments.js')}}

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Plaćanja</a></li>
	    </ul>
	</nav>
</div>
</br>

<div id="basicsearch" class="row">
	<div class='form-search'>
		<select name='search_item' id='basicPaymentSearch' placeholder="Pretraživanje prema jmbg putnika ili broju rezervacije" class='form-control'></select>
	</div>
	<div class="">
		 <a role="button" class="btn btn-default btn-small" id="bresetPayment">Resetuj pretragu</a>
		 <a role="button" class="paymentNewModal btn btn-default btn-small" id="addNewPayment" data-toggle="modal" href="#paymentNewModal">Dodaj novo plaćanje</a>
	</div>
</div>

{{ $payments->links() }}

<p/>
<div  id="paymentsData">
	{{ $paymentsPartial }}
</div>

<div class="row">
	<div class="span9">
		<div id="paymentNewModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Novo Plaćanje</h3>
			</div>
			{{ Form::open(array('url' => 'storePayment', 'name' => 'addNewPaymentForm', 'id' => 'addNewPaymentForm' )) }}
			<div class="modal-body">
				<table class="table">
					<tr>
						<td colspan='2'>
							<div class="input-control text">
								<input type="text" class="validate[required]" name="payment_type" id="payment_type" placeholder="Sredstvo plaćanja" />
								<input type="text" name="card_type" id="card_type" placeholder="Tip kartice" />
							</div>
						</td>
						<td colspan='2'>
							<div class="input-control text">
								<select name="passanger_search" id="passanger_search"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="reservation_num">Br. rezervacije</label>
								<input type="text" name="reservation_num" id="reservation_num"/>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-control text input-append date" id="birth_datepicker">
								<label for="res_date">Datum plaćanja</label>
								<input type="text" id="res_date" name="res_date"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="exchange_rate">Kurs</label>
								<input type="text" name="exchange_rate" id="exchange_rate"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
							 	<label for="amount_din">Dinarski deo</label>
								<input type="text" name="amount_din" id="amount_din"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="amount_eur_din">Devizni deo</label>
								<input type="text" name="amount_eur_din" id="amount_eur_din"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="fiscal_slip">Br. Fisk. isečka</label>
								<input type="text" name="fiscal_slip" id="fiscal_slip"/>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='2' rowspan='2'>
							<div class="input-control text">
								<label for="payment_method">Metod plaćanja</label>
								<textarea rows='2' name="payment_method" id="payment_method"></textarea>
							</div>
						</td>
						<td colspan='3' rowspan='2'>
							<div class="input-control text">
								<label for="description">Opis</label>
								<textarea rows='2' style="width:100%" name="description" id="description"></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="modal-footer">  
				<button type="submit" id="addNewPsg" class="btn btn-success">Sačuvaj</button>
				<a class="btn btn-cancel" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>

		<div id="paymentDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Detalji uplate</h3>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td colspan='2'>
							<div class="input-control text">
								<label for="paymenttype">Sredstvo plaćanja</label>
								<input type="text" name="paymenttype" id="paymenttype" readonly/>
							</div>
						</td>
						<td colspan='2'>
							<div class="input-control text">
								<label for="passanger">Putnik</label>
								<input type="text" name="passanger" id="passanger" readonly/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="reservationnum">Br. rezervacije</label>
								<input type="text" name="reservationnum" id="reservationnum" readonly/>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-control text input-append date" id="birth_datepicker">
								<label for="resdate">Datum plaćanja</label>
								<input type="text" id="resdate" name="resdate" readonly/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="exchangerate">Kurs</label>
								<input type="text" name="exchangerate" id="exchangerate" readonly/>
							</div>
						</td>
						<td>
							<div class="input-control text">
							 	<label for="amountdin">Dinarski deo</label>
								<input type="text" name="amountdin" id="amountdin" readonly/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="amounteurdin">Devizni deo</label>
								<input type="text" name="amounteurdin" id="amounteurdin" readonly/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<label for="fiscalslip">Br. Fisk. isečka</label>
								<input type="text" name="fiscalslip" id="fiscalslip" readonly/>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan='2' rowspan='2'>
							<div class="input-control text">
								<label for="paymentmethod">Metod plaćanja</label>
								<textarea rows='2' name="paymentmethod" id="paymentmethod" readonly></textarea>
							</div>
						</td>
						<td colspan='3' rowspan='2'>
							<div class="input-control text">
								<label for="paymentdescription">Opis</label>
								<textarea rows='2' style="width:100%" name="paymentdescription" id="paymentdescription" readonly></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="modal-footer">  
				<a class="btn" data-dismiss="modal">Odustani</a>  	
			</div>
		</div>
	</div>
</div>
@stop