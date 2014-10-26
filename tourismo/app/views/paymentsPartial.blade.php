<script type="text/javascript">
$(function(){
	var list = $(".paymentDetails");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
			$.ajax({
                url: 'paymentDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    payment_id: $(this)[0].name
                },
                error: function() {
                     $(".modal-footer btn-cancel").click();
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }

                    if (res.data != null) {
                        var psg = jQuery.parseJSON(res.data);
                        if (psg.payment_type == "kartica")
                            $(".modal-body #paymenttype")[0].setAttribute(
                                "value", psg.payment_type + " (" + psg.card_type + ")");
                        else
                            $(".modal-body #paymenttype")[0].setAttribute("value", psg.payment_type);
                        $(".modal-body #passanger")[0].setAttribute("value", psg.passanger_name
                            + " " + psg.passanger_surname + ", JMBG: " + psg.passanger_jmbg);
                        $(".modal-body #reservationnum")[0].setAttribute("value", psg.reservation_number);
                        if(psg.date != null && psg.date.toString() != "1970-01-01"
                            && psg.date.toString() != "0000-00-00") {
                            var date = new Date(psg.date);
                            $(".modal-body #resdate")[0].setAttribute("value",
                                date.getDate() + "-" +
                                (1 + date.getMonth()) + "-" +
                                date.getFullYear());
                        }
                        $(".modal-body #exchangerate")[0].setAttribute("value", psg.exchange_rate);
                        $(".modal-body #amountdin")[0].setAttribute("value", psg.amount_din);
                        $(".modal-body #amounteurdin")[0].setAttribute("value", psg.amount_eur_din);
                        $(".modal-body #paymentmethod")[0].setAttribute("value", psg.payment_method);
                        $(".modal-body #paymentdescription")[0].setAttribute("value", psg.description);
                        $(".modal-body #fiscalslip")[0].setAttribute("value", psg.fiscal_slip);
                        $(".modal-body #hidden_id")[0].setAttribute("value", psg.id);
                    };
                }
            });
		};
	}

    $('.input-append').click(function(event)
        {
            event.preventDefault();
        });
});

function storePayment(id){
    var answer = confirm ("Da li ste sigurni da želite da stornirate uplatu?");
    if (answer) {
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", "payment/delete/"+id, false );
        xmlHttp.send( null );
        location.reload( true );
    }
}
</script>


{{ $payments->links() }}

<table class="table">
	<thead style="font-weight:bold">
		<tr>
            <td>Broj Priznanice</td>
			<td>Sredstvo plaćanja</td>
			<td>Ime i jmbg putnika</td>
			<td>Broj rezervacije</td>
			<td>Datum uplate</td>
			<td>Kurs Eura</td>
			<td>Iznos (din)</td>
			<td>Iznos (eur)</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@foreach ($payments as $payment)
        <tr class="{{$payment->payment_status()}}">
            <td>{{ $payment->id }}</td>
			<td>{{ $payment->payment_type }}
				@if ($payment->payment_type == "kartica")
					{{ ' ('.$payment->card_type.')' }}
				@endif
			</td>
			<td>{{ $payment->passanger->name}} {{ $payment->passanger->surname }}, {{ $payment->passanger->jmbg }}</td>
			<td>
                <a name="contract{{$payment->getReservation()->id}}" id="printContract" href="contract/{{$payment->getReservation()->id}}" target="_blank" title="Štampa ugovora">
                    {{ $payment->reservation->reservation_number }}
                </a>
            </td>
			<td>{{ $payment->date }}</td>
			<td>{{ number_format($payment->exchange_rate, 2) }}</td>
			<td>{{ number_format($payment->amount_din, 2) }}</td>
			<td>{{ number_format(floatval($payment->amount_eur_din)/floatval($payment->exchange_rate), 2) }}</td>
			<td>
                @if (Auth::user()->isAdmin() && strlen($payment->payment_status()) == 0)
                    <a role="button" class="delPayment btn btn-default btn-small pull-right" name="delete{{$payment->id}}" id="delPayment{{$payment->id}}" title="Storniranje plaćanja" onclick="storePayment({{$payment->id}})">
                        <span class="icon-trash"></span>
                    </a>
                @endif
				<a class="paymentDetails btn btn-default btn-small pull-right" name="{{$payment->id}}" role="button" data-toggle="modal" href="#paymentDetailModal">
				    <span class="icon-edit"></span>
                </a>
			</td>
		</tr>
	@endforeach
</table>