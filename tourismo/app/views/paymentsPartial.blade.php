<script type="text/javascript">
$(function(){
	var list = $(".paymentDetails");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
            $("#paymentModal").show();
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
</script>


{{ $payments->links() }}

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
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
		<tr>
			<td>{{ $payment->payment_type }}
				@if ($payment->payment_type == "kartica")
					{{ ' ('.$payment->card_type.')' }}
				@endif
			</td>
			<td>{{ $payment->passanger->name}} {{ $payment->passanger->surname }}, {{ $payment->passanger->jmbg }}</td>
			<td>{{ $payment->reservation->reservation_number }}</td>
			<td>{{ $payment->date }}</td>
			<td>{{ $payment->exchange_rate }}</td>
			<td>{{ $payment->amount_din }}</td>
			<td>{{ floatval($payment->amount_eur_din)/floatval($payment->exchange_rate) }}</td>
			<td>
				<a class="paymentDetails btn btn-primary pull-right" name="{{$payment->id}}" role="button" data-toggle="modal" href="#paymentDetailModal">
				<span class="icon-edit"></span>
			</td>
		</tr>
	@endforeach
</table>