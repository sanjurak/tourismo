$(function(){

	$(".modal-body #card_type").hide();

	$(".modal-body #payment_type").change(function(){
		if ($(this).val()=="kartica")
			$(".modal-body #card_type").slideDown();
		else
			$(".modal-body #card_type").slideUp();
	});

	$('.modal-body #birth_datepicker input').datepicker({
		format: "d-m-yy"
	});

	$("#newReservation").click(function(event){
		event.preventDefault();

		$.ajax({
			url:"createReservation",
			type:'GET',
			success:function(data)
			{
				$("#reservations").empty().html(data);
			},
			error:function(){
				alert("ERROR");
			}
		});
	});
	
	
    $("#payment_type").change(function () {
        if($(this).val() == null) $(this).addClass("empty");
        else $(this).removeClass("empty");
    });
    $("#payment_type").change();

    $("#passanger_search").change(function () {
        if($(this).val() == null) $(this).addClass("empty");
        else $(this).removeClass("empty");

        $(".payment-table-data").show();
        if (window.globalPsgLeftToPay) {
            $("#psg_left_to_pay_din").text("DIN: "+window.globalPsgLeftToPay[$(this).val()].left_to_pay_din);
            $("#psg_left_to_pay_eur").text("EUR: "+window.globalPsgLeftToPay[$(this).val()].left_to_pay_eur);
            if (window.globalPsgLeftToPay[$(this).val()].left_to_pay_din <= 1.0)
                $(".modal-body #psg_left_to_pay_din")[0].setAttribute("style","color:green");
            else $(".modal-body #psg_left_to_pay_din")[0].setAttribute("style","color:red");
            if (window.globalPsgLeftToPay[$(this).val()].left_to_pay_eur <= 1.0)
                $(".modal-body #psg_left_to_pay_eur")[0].setAttribute("style","color:green");
            else $(".modal-body #psg_left_to_pay_eur")[0].setAttribute("style","color:red");
        } else {
            $("#psg_left_to_pay_din").text("DIN: 0");
            $("#psg_left_to_pay_eur").text("EUR: 0");
            $(".modal-body #psg_left_to_pay_din")[0].setAttribute("style","color:green");
            $(".modal-body #psg_left_to_pay_eur")[0].setAttribute("style","color:green");
        }
    });
    $("#passanger_search").change();

    $("#exchange_rate").focusout(function () {
        if ($(this)[0].value.length < 2) $(this)[0].value = $(".modal-body #session_exchange_rate")[0].value;
        else if ($(this)[0].value.indexOf(",") > -1) $(this)[0].value = $(this)[0].value.replace(",", ".");
    });

    $("#addNewPaymentForm").validationEngine();

    $("#addNewPaymentForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
    });

    $('#storeNewPayment').click(function(event){
        event.preventDefault();
        
        var data = $("#addNewPaymentForm").serialize()
        var obj = unserializeFormData(data);
        var msg = 'Broj ugovora: ' + obj.reservation_number + '\r';
        msg += 'Kurs eura: ' + Number(obj.exchange_rate).toFixed(2) + '\r';
        if(obj.hasOwnProperty('amount_din'))
            msg += 'Dinarski deo: ' + Number(obj.amount_din).toFixed(2) + '\r';
        if(obj.hasOwnProperty('amount_eur_din'))
            msg += 'Devizni deo u dinarima: ' + Number(obj.amount_eur_din).toFixed(2) + '\r';
        if(obj.hasOwnProperty('amount_eur_eur'))
            msg += 'Devizni deo u eurima: ' + Number(obj.amount_eur_eur).toFixed(2) + '\r';
        if(obj.hasOwnProperty('fiscal_slip'))
            msg += 'Br. fiskalnog isečka: ' + obj.fiscal_slip;
        var answer = confirm (msg);
        if (answer) {
            $('#paymentNewModal').modal('hide');
            $.ajax({

                url: "storePayment",
                type: "POST",
                data: data,
                success:function(data)
                {
                    if(data.status == "success")
                        window.open('paymentSlip/' + data.id);
                        location.reload();
                },
                error: function(){

                }
            });
        }
    });
    
    $("#amount_din").focusout(function() {
    	if ($("#amount_din").val())
    		$("#amount_din_eur").val(Math.round($("#amount_din").val()/$("#exchange_rate").val()*100)/100);
    });
    
    $("#amount_din_eur").focusout(function() {
    	if ($("#amount_din_eur").val())
    		$("#amount_din").val($("#amount_din_eur").val()*$("#exchange_rate").val());
    });
    
    $("#amount_eur_din").focusout(function() {
    	if ($("#amount_eur_din").val())
    		$("#amount_eur_eur").val(Math.round($("#amount_eur_din").val()/$("#exchange_rate").val()*100)/100);
    });
    
    $("#amount_eur_eur").focusout(function() {
    	if ($("#amount_eur_eur").val())
    		$("#amount_eur_din").val($("#amount_eur_eur").val()*$("#exchange_rate").val());
    });
    
    $('#res_datepicker input').datepicker();
    $('#res_datepicker input').datepicker( "option", "dateFormat", "d-m-yy" );
});

function unserializeFormData(data) {
    var objs = [], temp;
    var temps = data.split('&');

    for(var i = 0; i < temps.length; i++){
        temp = temps[i].split('=');
        if (temp[1]) {
            objs.push(temp[0]);
            objs[temp[0]] = decodeURIComponent(temp[1]); 
        }
    }
    return objs; 
}