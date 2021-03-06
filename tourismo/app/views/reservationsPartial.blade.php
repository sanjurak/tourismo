@section('javascripts')
	{{HTML::script('scripts/reservationsMain.js')}}
@stop
<script type="text/javascript">
$(function(){

	$(".editableC").editable();
	
	$(".editReservation").click(function(event){
	
		event.preventDefault();
		
		$resid = $(this).attr("name");
		
		$.ajax({
			url: "editReservation/" + $resid,
			type: "GET",
			success: function(data)
			{
				$("#reservations").empty().html(data);
			},
			error:function(){
				alert("ERROR");
			}
		});
	});
	
	$(".resDelete").click(function(event){
	
		event.preventDefault();

		$resid = $(this).attr("data-id");
		$("#stornoResId").val($resid);
		$("#storno").modal("show");
		
		/*if(confirm ("Da li ste sigurni da �elite da stornirate rezervaciju?"))
		{
			$resid = $(this).attr("data-id");
			
			$.ajax({
				url: "reservation/delete/" + $resid,
				type: "GET",
				success: function(data)
				{
				if(data.status = "success")
					window.location.href = "reservations";
				},
				error:function(data){
					alert(data.message);
				}
			});
		}*/
	});

	$("#stornoOK").click(function(event){
		event.preventDefault();

		$.ajax({
				url: "reservation/delete",
				type: "POST",
			data: $("#stornoForm").serialize(),
				success: function(data)
				{
				if(data.status = "success")
					window.location.href = "reservations";
				},
				error:function(data){
					alert(data.message);
					$("#storno").modal("close");
				}
			});

	});

	$("#stornoCancel").click(function(event){
		$("#storno").modal("close");
	});
	
	
	var list = $(".paymentNewModal");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
		
		$("#paymentModal").show();
		
			$.ajax({
                url: 'paymentRsrvDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    rsrv_id: $(this)[0].name
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        if (list[i].getAttribute("id") != "session_exchange_rate" &&
                        	list[i].getAttribute("id") != "reservation_number" &&
                        	list[i].getAttribute("id") != "reservation_number_i")
                        	list[i].value = "";
                    }
                    $(".modal-body #exchange_rate")[0].value = $(".modal-body #session_exchange_rate")[0].value;
                    $(".modal-body #exchange_rate_i")[0].value = $(".modal-body #session_exchange_rate")[0].value;
                    
                    $("#type_of_payment")[0].value = "0";
		            $("#excursion-form").slideUp();
		            $("#payment-form").slideDown();

                    $(".modal-body #payment_type")[0].value = "";
                    $(".modal-body #card_type").hide();
                    list = $(".modal-body textarea");
                    for (i = 0, len = list.length; i < len; i++){
                       	list[i].value = "";
                    }
                    var selectbox = $(".modal-body #passanger_search")[0];
                    var i;
				    for(i=selectbox.options.length-1;i>=1;i--)
				    {
				        selectbox.remove(i);
				    }
					selectbox = $(".modal-body #passanger_search_i")[0];
				    for(i=selectbox.options.length-1;i>=1;i--)
				    {
				        selectbox.remove(i);
				    }

                    if (res.data != null) {
                        var prd = jQuery.parseJSON(res.data);
                        
                        $(".modal-body #reservation_id")[0].setAttribute("value", prd.reservation_id);
                        $(".modal-body #reservation_id_i")[0].setAttribute("value", prd.reservation_id);
                        $(".modal-body #reservation_number")[0].setAttribute("value", prd.reservation_number);
                    	$(".modal-body #reservation_number_i")[0].setAttribute("value", prd.reservation_number);
                    	
                    	prd.passanger_names.forEach(function(entry) {
    						var opt = document.createElement('option');
							opt.value = entry[0];
							opt.innerHTML = entry[1];
							$(".modal-body #passanger_search")[0].appendChild(opt);
						});
                    	selectPsgs = $(".modal-body #passanger_search")[0];
						for(var i = 0; i < selectPsgs.length; i++) {
						  selectPsgs[i].selectedIndex = 0;
						}
						$('.modal-body #passanger_search option:first-child').attr("selected", "selected");
						
						prd.passanger_names_i.forEach(function(entry) {
    						var opt = document.createElement('option');
							opt.value = entry[0];
							opt.innerHTML = entry[1];
							$(".modal-body #passanger_search_i")[0].appendChild(opt);
						});
                    	selectPsgs = $(".modal-body #passanger_search_i")[0];
						for(var i = 0; i < selectPsgs.length; i++) {
						  selectPsgs[i].selectedIndex = 0;
						}
						$('.modal-body #passanger_search_i option:first-child').attr("selected", "selected");

						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						$(".modal-body #res_date").val(dd+"-"+mm+"-"+yyyy);
						$(".modal-body #res_date_i").val(dd+"-"+mm+"-"+yyyy);
						
						$(".modal-body #left_to_pay_din")[0].innerHTML = "DIN: "+prd.left_to_pay_din;
						if (prd.left_to_pay_din <= 0.0)
							$(".modal-body #left_to_pay_din")[0].setAttribute("style","color:green");
						else
							$(".modal-body #left_to_pay_din")[0].setAttribute("style","color:red");
						$(".modal-body #left_to_pay_eur")[0].innerHTML = "EUR: "+prd.left_to_pay_eur;
						if (prd.left_to_pay_eur <= 0.0)
							$(".modal-body #left_to_pay_eur")[0].setAttribute("style","color:green");
						else
							$(".modal-body #left_to_pay_eur")[0].setAttribute("style","color:red");
						globalPsgLeftToPay = prd.passanger_left_to_pay;
						
						$(".modal-body #left_to_pay_din_i")[0].innerHTML = "DIN: "+prd.left_to_pay_din_i;
						if (prd.left_to_pay_din_i <= 0.0)
							$(".modal-body #left_to_pay_din_i")[0].setAttribute("style","color:green");
						else
							$(".modal-body #left_to_pay_din_i")[0].setAttribute("style","color:red");
						$(".modal-body #left_to_pay_eur_i")[0].innerHTML = "EUR: "+prd.left_to_pay_eur_i;
						if (prd.left_to_pay_eur_i <= 0.0)
							$(".modal-body #left_to_pay_eur_i")[0].setAttribute("style","color:green");
						else
							$(".modal-body #left_to_pay_eur_i")[0].setAttribute("style","color:red");
						globalPsgLeftToPayI = prd.passanger_left_to_pay_i;
	                }
				}
			});			
			$("#left_to_pay_din").text("DIN: 0");
			$(".modal-body #left_to_pay_din")[0].setAttribute("style","color:green");
            $("#left_to_pay_eur").text("EUR: 0");
            $(".modal-body #left_to_pay_eur")[0].setAttribute("style","color:green");
            $("#psg_left_to_pay_din").text("DIN: 0");
            $(".modal-body #psg_left_to_pay_din")[0].setAttribute("style","color:green");
            $("#psg_left_to_pay_eur").text("EUR: 0");
            $(".modal-body #psg_left_to_pay_eur")[0].setAttribute("style","color:green");
    		$(".payment-table-data").hide();
    		
    		$("#left_to_pay_din_i").text("DIN: 0");
			$(".modal-body #left_to_pay_din_i")[0].setAttribute("style","color:green");
            $("#left_to_pay_eur_i").text("EUR: 0");
            $(".modal-body #left_to_pay_eur_i")[0].setAttribute("style","color:green");
            $("#psg_left_to_pay_din_i").text("DIN: 0");
            $(".modal-body #psg_left_to_pay_din_i")[0].setAttribute("style","color:green");
            $("#psg_left_to_pay_eur_i").text("EUR: 0");
            $(".modal-body #psg_left_to_pay_eur_i")[0].setAttribute("style","color:green");
            $(".payment-table-data-i").hide();
		}
	}

});

</script>

{{$reservations->links()}}

<table class="table table-hover">
		<tr>
			<th>Broj rezervacije</th>
			<th>Datum rezervacije</th>
			<th>Organizator putovanja</th>
			<th>Destinacija</th>
			<th>Status rezervacije</th>
			<th></th>
		</tr>
@foreach($reservations as $reservation)
	<tr class="{{$reservation->payment_status()}}">
		<td>			
			{{$reservation->reservation_number}}
			@if ($reservation->internal)
				<span class="icon-info-sign"></span>
			@endif
		</td>
		<td>			
			{{$reservation->reservation_date}}
			
		</td>
		<td>
			{{$reservation->traveldeal->organizer->name}}
		</td>
		<td>
			{{$reservation->traveldeal->destination->name}}
		</td>
		<td>
			{{$reservation->status}}
		</td>
		<td>
			
			
			@if($reservation->reservation_id)
				<a role="button" class="btn btn-default btn-small" name="contract{{$reservation->reservation_id}}" id="printContract" href="contract/{{$reservation->reservation_id}}" target="_blank" title="�tampa ugovora">
					<span class="icon-print"></span>
				</a>
				@if ($reservation->status != "Storno")
				<a role="button" class="paymentNewModal btn btn-default btn-small" name="{{$reservation->reservation_id}}" id="addNewPayment" data-toggle="modal" href="#paymentNewModal" title="Dodaj novo placanje">
					<span class="icon-plus"></span>
				</a>
				<a role="button" class="btn btn-default btn-small editReservation" name="{{$reservation->reservation_id}}"  href="#" title="Izmena rezervacije">
					<span class="icon-edit"></span>
				</a>
					@if (Auth::user()->isAdmin())
					<a role="button" class="btn btn-default btn-small resDelete" name="delete{{$reservation->reservation_id}}" id="delReservation{{$reservation->reservation_id}}" data-toggle="modal" title="Storniranje rezervacije" data-id={{$reservation->reservation_id}} >
						<span class="icon-trash"></span>
					</a>
					@endif
				@endif
			@else
				<a role="button" class="btn btn-default btn-small" name="contract{{$reservation->id}}" id="printContract" href="contract/{{$reservation->id}}" target="_blank" title="�tampa ugovora">
					<span class="icon-print"></span>
				</a>
				@if ($reservation->status != "Storno")
				<a role="button" class="paymentNewModal btn btn-default btn-small" name="{{$reservation->id}}" id="addNewPayment" data-toggle="modal" href="#paymentNewModal" title="Dodaj novo placanje">
					<span class="icon-plus"></span>
				</a>
				<a role="button" class="btn btn-default btn-small editReservation" name="{{$reservation->id}}"  href="#" title="Izmena rezervacije">
					<span class="icon-edit"></span>
				</a>
					@if (Auth::user()->isAdmin())
					<a role="button" class="btn btn-default btn-small resDelete" name="delete{{$reservation->id}}" id="delReservation{{$reservation->id}}" data-toggle="modal" title="Storniranje rezervacije" data-id={{$reservation->id}} >
						<span class="icon-trash"></span>
					</a>
					@endif
				@endif
			@endif
			
		</td>
	</tr>
@endforeach
</table>