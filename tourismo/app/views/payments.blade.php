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
	</div>
</div>

<p/>
<div  id="paymentsData">
	{{ $paymentsPartial }}
</div>

<div class="row">
	<div class="span9">
		<div id="paymentDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">			
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
				<input type="hidden" id="hidden_id">
			</div>

			<div class="modal-footer">  
				<a id="printPayment" class="btn" data-dismiss="modal">Štampa</a>  	
				<a class="btn" data-dismiss="modal">Odustani</a>  	
			</div>
		</div>
	</div>
</div>
@stop