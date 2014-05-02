$(function(){

	$(".modal-body #card_type").hide();

	$(".modal-body #payment_type").change(function(){
		if ($(this).val()=="kartica")
			$(".modal-body #card_type").slideDown();
	});

    $('.modal-body #birth_datepicker input').click(function(e){
    	e.preventDefault();
    	$('.modal-body #birth_datepicker input').datepicker('show');
    });

    $('.modal-body #birth_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
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


	var list = $(".paymentNewModal");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
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
                        if (list[i].getAttribute("id") != "exchange_rate")
                        	list[i].removeAttribute("value");
                    }
                    $(".modal-body #payment_type")[0].value = "";
                    var selectbox = $(".modal-body #passanger_search")[0];
                    var i;
				    for(i=selectbox.options.length-1;i>=1;i--)
				    {
				        selectbox.remove(i);
				    }

                    if (res.data != null) {
                        var prd = jQuery.parseJSON(res.data);
                        $(".modal-body #reservation_id")[0].setAttribute("value", prd.reservation_id);
                        $(".modal-body #reservation_number")[0].setAttribute("value", prd.reservation_number);
                    	prd.passanger_names.forEach(function(entry) {
    						var opt = document.createElement('option');
						    opt.value = entry[0];
						    opt.innerHTML = entry[1];
						    $(".modal-body #passanger_search")[0].appendChild(opt);
						});
						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();
						$(".modal-body #res_date")[0].setAttribute("value", yyyy+"/"+mm+"/"+dd);

                    }
				}
			});
		}
	}


    $("#payment_type").change(function () {
        if($(this).val() == null) $(this).addClass("empty");
        else $(this).removeClass("empty");
    });
    $("#payment_type").change();

    $("#passanger_search").change(function () {
        if($(this).val() == null) $(this).addClass("empty");
        else $(this).removeClass("empty");
    });
    $("#passanger_search").change();

    $("#addNewPaymentForm").validationEngine();

    $("#addNewPaymentForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
    });
});