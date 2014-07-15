$(function(){
$("#traveldealsSel").selectize({
	valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        onInitialize: function(){
        	$.ajax({
        		url: "initializeTD",
        		type:"GET",
        		success: function(data)
        		{
        			var selectize = $("#traveldealsSel")[0].selectize;
        			
        			selectize.addOption(data.data);
        			//selectize.refreshOptions();
        		},
        		error: function(){}
        	});
        },
        onChange: function()
        {
        	var item = this.options[this.items[0]];
        	this.close();

        	$("#category").val(item["category"]["name"]);
				$("#organizer").val(item["organizer"]["name"]);
				$("#destination").val(item["destination"]["name"]);
				$("#accomodation").val(item["accomodation"]+" "+item["accomodation_unit"]["name"]+"/"+item["accomodation_unit"]["capacity"]);
				$("#transportation").val(item["transportation"]);
				$("#service").val(item["service"]);
                $("#traveldealId").val(item["id"]);

		$("#traveldealDetails").slideDown();

        }
	});
	var psgCounter = 0;

	$("#passangersSel").selectize({
		valueField: 'id',
        labelField: 'passanger',
        searchField: ['passanger'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.passanger )+'</div>';
            }
        },
        onInitialize: function(){
        	$.ajax({
        		url: "initializePS",
        		type:"GET",
        		success: function(data)
        		{
        			var selectize = $("#passangersSel")[0].selectize;
        			
        			selectize.addOption(data.data);
        			//selectize.refreshOptions();
        		},
        		error: function(){}
        	});
        },
        onChange: function()
        {
        	var item = this.options[this.items[0]];
        	this.close();

        	$("<div class='psg-item'>"+item.passanger
                +"<input type='hidden' name='Passangers[" + psgCounter +"]' class='passangers' value='"+item.id+"'/>"
                +"<a href='#' class='remove-psg pull-right'>"
                +"<span class='icon icon-remove-sign'></span></a></div>")
            .appendTo("#passangersDetails");


            psgCounter++;
        }
	});
	$('#start_datepicker input').datepicker({
        format: "d-m-yy"
    });
    
     $("#passangersDetails").on("click", ".remove-psg", function(e){
        e.preventDefault();
        $(this).parents("div.psg-item").remove();
    });
    
     $("#passangersDetails").on("click", ".delete-psg", function(e){
        e.preventDefault();
        $(this).siblings("#psgDelete").val("1");
        $(this).siblings("#psgId").removeClass("passangers");
        $(this).parents("div.psg-item").addClass("psgDeleted");
        $(this).siblings(".undo-psg").show();
        $(this).hide();
    });
    
     $("#passangersDetails").on("click", ".undo-psg", function(e){
        e.preventDefault();
        $(this).siblings("#psgDelete").val("0");
        $(this).siblings("#psgId").addClass("passangers");
        $(this).parents("div.psg-item").removeClass("psgDeleted");
        $(this).siblings(".delete-psg").show();
        $(this).hide();
    });

    $("#start_datepicker span").click(function(){
      $('#start_datepicker input').datepicker("show");  
    });


    $('#end_datepicker input').datepicker({
        format: "d-m-yy"
    });

    $("#end_datepicker span").click(function(){
      $('#end_datepicker input').datepicker("show");  
    });


    $('#travel_datepicker input').datepicker({
        format: "d-m-yy"
    });

    $("#travel_datepicker span").click(function(){
      $('#travel_datepicker input').datepicker("show");  
    });
    
    //PLACANJA

    
      var itemCounter = 0;
    $("#removeItem").click(function(e){
        e.preventDefault();
        var totaldin = +$("#totalDIN").val() - +$(this).siblings("#paymentItemTotalDin").val(); 
        var totaleuro = +$("#totalEUR").val() - +$(this).siblings("#paymentItemTotalEuro").val();
        
        $("#totalDIN").val(totaldin);
        $("#totalEUR").val(totaleuro);
        $(this).parents("div#paymentItem").remove();
    });

    $("#addPaymentItem").click(function(event){
        event.preventDefault();
        var items = $(".hiddenItem").clone(true);
        items.show().removeClass("hiddenItem");
        items.find("#paymentItemName").attr("name","Item["+itemCounter+"][name]").addClass("validate[required]");
        items.find("#paymentItemEuro").attr("name","Item["+itemCounter+"][euro]").addClass("validate[required]");
        items.find("#paymentItemDin").attr("name","Item["+itemCounter+"][din]").addClass("validate[required]");
        items.find("#paymentItemNum").attr("name","Item["+itemCounter+"][num]").addClass("validate[required]");
        items.find("#paymentItemTotalDin").attr("name","Item["+itemCounter+"][totaldin]").addClass("validate[required]");
        items.find("#paymentItemTotalEuro").attr("name","Item["+itemCounter+"][totaleuro]").addClass("validate[required]");
        items.find("#isExcursion").attr("name","Item["+itemCounter+"][isExcursion]").addClass("excursionChk");

        itemCounter++;
        $(items).appendTo("#paymentItems");
    });

    $(".euroItem").focusout(function(){
        var total = $(this).val() * $(this).siblings("#paymentItemNum").val();
       $(this).siblings("#paymentItemTotalEuro").val(total);

        var totaleur = 0;

        $("#paymentItems div#paymentItem").each(function(){
      	   if($(this).find("#paymentItemName").val() == "Popust")
            	totaleur -= +$(this).find("#paymentItemTotalEuro").val();
            else
            	totaleur += +$(this).find("#paymentItemTotalEuro").val();
        });
        $("#totalEUR").val(totaleur);
    });  

    $(".dinItem").focusout(function(){
        var total = $(this).val() * $(this).siblings("#paymentItemNum").val();
       $(this).siblings("#paymentItemTotalDin").val(total);

       var totaldin = 0;

        $("#paymentItems div#paymentItem").each(function(){
        	if($(this).find("#paymentItemName").val() == "Popust")
            		totaldin -= +$(this).find("#paymentItemTotalDin").val();
            	else
            		totaldin += +$(this).find("#paymentItemTotalDin").val();
        });
        $("#totalDIN").val(totaldin);
    });   

    $(".numItem").focusout(function(){
        var totaldinitem = $(this).val() * $(this).siblings(".dinItem").val();
        var totaleuritem = $(this).val() * $(this).siblings(".euroItem").val();
        $(this).siblings("#paymentItemTotalDin").val(totaldinitem);
        $(this).siblings("#paymentItemTotalEuro").val(totaleuritem);
        var totaldin = 0;
        var totaleur = 0;

        $("#paymentItems div#paymentItem").each(function(){
            if($(this).find("#paymentItemName").val() == "Popust"){
            	totaldin -= +$(this).find("#paymentItemTotalDin").val();
            	totaleur -= +$(this).find("#paymentItemTotalEuro").val();
            } else {
            	totaldin += +$(this).find("#paymentItemTotalDin").val();
            	totaleur += +$(this).find("#paymentItemTotalEuro").val();
            }
        });
        $("#totalDIN").val(totaldin);
        $("#totalEUR").val(totaleur);
    }); 
    
	 $("#paymentItems div#paymentItem").each(function(){
	 	$(this).find(".numItem").trigger("focusout");
	 });
	 
    $("#paymentItems").on("click", ".delete-pay", function(e){
        e.preventDefault();
        $(this).siblings("#PriceDelete").val("1");
        $(this).siblings("#PriceId").removeClass("payments");
        $(this).parents("div.paymentItem").addClass("payDeleted");
        $(this).siblings().prop("readonly", true);
        $(this).siblings(".undo-pay").show();
        $(this).hide();
        
        var totaldin = +$("#totalDIN").val() - +$(this).siblings("#paymentItemTotalDin").val(); 
        var totaleuro = +$("#totalEUR").val() - +$(this).siblings("#paymentItemTotalEuro").val();
        
        $("#totalDIN").val(totaldin);
        $("#totalEUR").val(totaleuro);
    });
    
     $(".undo-pay").click(function(e){
        e.preventDefault(); 
        $(this).siblings("#PriceDelete").val("0");
        $(this).siblings("#PriceId").addClass("payments");
        $(this).parents("div.paymentItem").removeClass("payDeleted");
        $(this).siblings().prop("readonly", false);
        $(this).siblings(".delete-pay").show();
        $(this).hide();
        
        var totaldin = +$("#totalDIN").val() + +$(this).siblings("#paymentItemTotalDin").val(); 
        var totaleuro = +$("#totalEUR").val() + +$(this).siblings("#paymentItemTotalEuro").val();
        
        $("#totalDIN").val(totaldin);
        $("#totalEUR").val(totaleuro);
    });
	 
      $("#editReservationForm").validationEngine();
      $("#passangersDetailsForm").validationEngine();
      $("#generalInfo").validationEngine();
      $("#paymentDetailsForm").validationEngine();
      
      $("#editReservationForm").submit(function(e){
       e.preventDefault();
       
       var data = $("#editReservationForm").serialize() + "&" + $("#passangersDetailsForm").serialize() 
       			+ "&" + $("#generalInfo").serialize() + "&" + $("#paymentDetailsForm").serialize();
       
     var resId = $("#reservationId").val();
        $.ajax({

            url: "updateReservation/" + resId,
            type: "POST",
            data: data,
            success:function(data)
            {
                if(data.status == "success")
                {
                    window.open('contract/' + data.id);
                  window.location.href = "reservations";
                }
            },
            error: function(){

            }
        });
    });
    
     $("#editReservationBtn").click(function(e){
       e.preventDefault();
       var valid = false;
       $("#passangersDetails .psg-item").each(function(){
       	 if (!$(this).hasClass("psgDeleted"))
       	 	valid = true;
       	});
      
       if(!valid)
       {       		
            $("#psgMessage").show();
            return;
        }
        
        valid = false;
        
        $("#paymentItems .paymentItem").each(function(){
        	if(!$(this).hasClass("payDeleted"))
        		valid = true;
        });
        
        if(!valid)
        {
        	$("#payMessage").show();
        	return;
        }
       if($("#editReservationForm").validationEngine("validate") && $("#passangersDetailsForm").validationEngine("validate") && $("#generalInfo").validationEngine("validate") && $("#paymentDetailsForm").validationEngine("validate"))
            $("#editReservationForm").trigger("submit");
        
    });
});