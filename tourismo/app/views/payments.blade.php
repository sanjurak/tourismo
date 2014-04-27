@extends('home')
@section('content')

<h1><a href="homepage"><i class="icon-circle-arrow-left large"></i></a>
	Plaćanja
</h1>

<div id="basicsearch" class="row">
	<div class='form-search'>
		<select name='search_item' id='basicPaymentSearch' placeholder="Pretraživanje prema jmbg putnika, broju rezervacije ili datumu" class='form-control'></select>
	</div>
	<div class="">
		 <a role="button" class="btn btn-default btn-small" id="bresetPsg">Resetuj pretragu</a>
		 <a role="button" class="paymentDetails btn btn-default btn-small" id="addNewPayment" data-toggle="modal" href="#paymentDetailModal">Dodaj novo plaćanje</a>
	</div>
</div>

{{ $payments->links() }}

<p/>
<div  id="passangersData">
	{{ $paymentsPartial }}
</div>

<div class="row">
	<div class="span9">
		<div id="paymentDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Novo Plaćanje</h3>
			</div>
			{{ Form::open(array('url' => 'storePayment', 'name' => 'addNewPaymentForm', 'id' => 'addNewPaymentForm' )) }}
			<div class="modal-body">

			</div>

			<div class="modal-footer">  
				<button type="submit" id="addNewPsg" class="btn btn-success">Sačuvaj</button>
				<a class="btn" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop