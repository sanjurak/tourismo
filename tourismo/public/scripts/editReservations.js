$(function(){
    
    var TravelDealPriceEur = 0;
    var TravelDealPriceDin = 0;

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

                TravelDealPriceDin = item["price_din"];
                TravelDealPriceEur = item["price_eur"];

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
            
            var items = $(".hiddenPsgItems").clone(true);
            items.show().removeClass("hiddenPsgItems").attr("id",item.id);
            items.addClass("psgPayment");
            items.find("#psgName").text("Detalji plaćanja za putnika: " + item.passanger.substring(0, item.passanger.indexOf("JMBG") - 1));
           
            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Smeštaj Adl");
            items.find("#paymentItems div").last().find("#paymentItemEuro").val(TravelDealPriceEur);
            items.find("#paymentItems div").last().find("#paymentItemDin").val(TravelDealPriceDin);
            items.find("#paymentItems div").last().find("#paymentItemNum").val("1");

            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Smeštaj Chld");
            
            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Prevoz Adl");
            
            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Prevoz Chld");
            
            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Popust");
            
            items.find("#addPsgPaymentItem").trigger("click");
            items.find("#paymentItems div").last().find("#paymentItemName").val("Doplata");

            $(items).appendTo("#psgPaymentDetails");


            items.find("#paymentItems div").first().find("#paymentItemEuro").trigger("focusin").trigger("focusout");
            items.find("#paymentItems div").first().find("#paymentItemDin").trigger("focusin").trigger("focusout");
            items.find("#paymentItems div").first().find("#paymentItemName").trigger("focusin");

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

    //inicijalizacija brojaca za forme detalja placanja putnika 
    //i pojedinacna placanja za svakog putnika

      var itemCounter = 0;
      var psgItemCounter = 0;

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
        items.find("#paymentItemName").attr("name","Item["+itemCounter+"][name]").addClass("validate[required]").prop("readonly", true);;
        items.find("#paymentItemEuro").attr("name","Item["+itemCounter+"][euro]").addClass("validate[required]").prop("readonly", true);;
        items.find("#paymentItemDin").attr("name","Item["+itemCounter+"][din]").addClass("validate[required]").prop("readonly", true);;
        items.find("#paymentItemNum").attr("name","Item["+itemCounter+"][num]").addClass("validate[required]").prop("readonly", true);;
        items.find("#paymentItemTotalDin").attr("name","Item["+itemCounter+"][totaldin]").addClass("validate[required]").prop("readonly", true);;
        items.find("#paymentItemTotalEuro").attr("name","Item["+itemCounter+"][totaleuro]").addClass("validate[required]").prop("readonly", true);;
        items.find("#isExcursion").attr("name","Item["+itemCounter+"][isExcursion]").addClass("excursionChk");

        items.find("#removeItem").remove();
        itemCounter++;
        $(".finalPayment").find("#paymentItems").append(items);
    });

    $("#addPsgPaymentItem").click(function(event){
        event.preventDefault();
        var items = $(".hiddenItem").clone(true);
        var id = $(this).parents(".psgPayment").attr("id");
        items.show().removeClass("hiddenItem");
        items.find("#paymentItemName").attr("name","PsgItem["+id+"]["+psgItemCounter+"][name]").addClass("validate[required]");
        items.find("#paymentItemEuro").attr("name","PsgItem["+id+"]["+psgItemCounter+"][euro]").addClass("validate[required]");
        items.find("#paymentItemDin").attr("name","PsgItem["+id+"]["+psgItemCounter+"][din]").addClass("validate[required]");
        items.find("#paymentItemNum").attr("name","PsgItem["+id+"]["+psgItemCounter+"][num]").addClass("validate[required]");
        items.find("#paymentItemTotalDin").attr("name","PsgItem["+id+"]["+psgItemCounter+"][totaldin]").addClass("validate[required]");
        items.find("#paymentItemTotalEuro").attr("name","PsgItem["+id+"]["+psgItemCounter+"][totaleuro]").addClass("validate[required]");
        items.find("#isExcursion").attr("name","PsgItem["+id+"]["+psgItemCounter+"][isExcursion]").addClass("excursionChk");
        
        items.find("#paymentItemPsgId").attr("name","PsgItem["+id+"]["+psgItemCounter+"][psgID]");
        items.find("#paymentItemPsgId").val(id);
        $(this).siblings("#paymentDetailsForm").find("#paymentItems").append(items);
        
        psgItemCounter++;
    });

    var oldEuro = 0, oldDin = 0;
    var oldNameItem = "";

    $(".nameItem").focusin(function(){
        oldNameItem = $(this).val();
    });

    $(".nameItem").focusout(function(){

        var currName = $(this).val();

        if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
        {
          
            $(this).siblings("#paymentItemName").val(currName);
            $(this).siblings("#paymentItemEuro").trigger("focusin").trigger("focusout");
            $(this).siblings("#paymentItemDin").trigger("focusin").trigger("focusout");

            var count = 0;

            $(".psgPayment").find("div#paymentItem").each(function(){ 
                if($(this).find("#paymentItemName").val() == oldNameItem)
                {
                    count++;
                    if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
                    {
                        $(this).find("#paymentItemEuro").trigger("focusin").trigger("focusout");   
                        $(this).find("#paymentItemDin").trigger("focusin").trigger("focusout");   
                    }
                }
            });

            if(count <= 1)
            {                        
                $(".finalPayment").find("#paymentItemName").each(function(){

                    if($(this).val() == oldNameItem)
                        $(this).parents("#paymentItem").remove();
                });
            }

        }

    });

    $(".euroItem").focusin(function(){
        oldEuro = $(this).val();
    });

    $(".euroItem").focusout(function(){
        
       var itemName = $(this).siblings("#paymentItemName").val();  

       if(+$(this).siblings("#paymentItemNum").val() == 0 && +$(this).val() > 0)
        {
            $(this).siblings("#paymentItemNum").val("1");
        }     

        var total = $(this).val() * $(this).siblings("#paymentItemNum").val();
        $(this).siblings("#paymentItemTotalEuro").val(total);

        if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
        {
            var success = false, generate = false;
            var euroItem = $(this).val();
            var num = 0;
            var dinItem = $(this).siblings("#paymentItemDin").val();

            $("#psgPaymentDetails").find("div#paymentItem").each(function(){                
                
                if(($(this).find("#paymentItemName").val() == itemName))
                {
                    var count = +$(this).find("#paymentItemNum").val();
                    if(count == 0)
                    {
                        count++;
                        $(this).find("#paymentItemNum").val(count);
                    }

                    var euroEl = $(this).find("#paymentItemEuro");
                    if(+euroEl.val() != euroItem)
                        euroEl.val(euroItem).trigger("focusout");
                    num = num + +$(this).find("#paymentItemNum").val();
                }

            });


            $(".finalPayment").find("#paymentItemName").each(function(){

                if($(this).val() == itemName)
                {
                    var item = $(this).siblings("#paymentItemEuro");
                                        
                    item.val(euroItem);
                    item.siblings("#paymentItemNum").val(num).trigger("focusout");
                    success = true;
                }

            });

            if(!success)
            {
                $("#addPaymentItem").trigger("click");
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemName").val(itemName);
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemNum").val(num);
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemEuro").val(euroItem).trigger("focusout");
                
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemName").attr("data-val",itemName);
            }
            
        }
            var totaleur = 0;

        $(this).parents("#paymentItems").find("div#paymentItem").each(function(){
           if(/Popust/i.test($(this).find("#paymentItemName").val()))
                totaleur -= +$(this).find("#paymentItemTotalEuro").val();
            else
                totaleur += +$(this).find("#paymentItemTotalEuro").val();
        });
        $(this).parents(".psgPayment").find("#totalEUR").val(totaleur);
    });  

    $(".dinItem").focusout(function(){
        
        var itemName = $(this).siblings("#paymentItemName").val();  

         if(+$(this).siblings("#paymentItemNum").val() == 0 && +$(this).val() > 0)
        {
            $(this).siblings("#paymentItemNum").val("1");
        } 

        var total = $(this).val() * $(this).siblings("#paymentItemNum").val();
        $(this).siblings("#paymentItemTotalDin").val(total);     

        if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
        {
            var success = false;
            var dinItem = $(this).val();
            var num = 0;

            $("#psgPaymentDetails").find("div#paymentItem").each(function(){
                                    
                if($(this).find("#paymentItemName").val() == itemName)
                {
                    var count = +$(this).find("#paymentItemNum").val();
                    if(count == 0)
                    {
                        count++;
                        $(this).find("#paymentItemNum").val(count);
                    }

                    var dinEl = $(this).find("#paymentItemDin");
                    if(+dinEl.val() != dinItem)
                        dinEl.val(dinItem).trigger("focusout");
                    num = num + +$(this).find("#paymentItemNum").val();
                }

            });

            $(".finalPayment").find("#paymentItemName").each(function(){

                if($(this).val() == itemName)
                {
                    var item = $(this).siblings("#paymentItemDin");
                                        
                    item.val(dinItem);
                    item.siblings("#paymentItemNum").val(num).trigger("focusout");
                    success = true;
                }

            });

            if(!success)
            {
                $("#addPaymentItem").trigger("click");
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemName").val(itemName);
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemNum").val(num);
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemDin").val(dinItem).trigger("focusout");
                
                $(".finalPayment").find("#paymentItems div").last().find("#paymentItemName").attr("data-val",itemName);
            }
            
        }

       var totaldin = 0;

        $(this).parents("#paymentItems").find("div#paymentItem").each(function(){
            if(/Popust/i.test($(this).find("#paymentItemName").val()))// == "Popust")
                    totaldin -= +$(this).find("#paymentItemTotalDin").val();
                else
                    totaldin += +$(this).find("#paymentItemTotalDin").val();
        });
        $(this).parents(".psgPayment").find("#totalDIN").val(totaldin);
    });   

    $(".numItem").focusout(function(){
        var totaldinitem = $(this).val() * $(this).siblings(".dinItem").val();
        var totaleuritem = $(this).val() * $(this).siblings(".euroItem").val();
        $(this).siblings("#paymentItemTotalDin").val(totaldinitem);
        $(this).siblings("#paymentItemTotalEuro").val(totaleuritem);

        var itemName = $(this).siblings("#paymentItemName").val();    
        var num = 0;   

        if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
        {
            $("#psgPaymentDetails").find("div#paymentItem").each(function(){
                                    
                if($(this).find("#paymentItemName").val() == itemName)
                {
                    num = num + +$(this).find("#paymentItemNum").val();
                }

            });

            $(".finalPayment").find("#paymentItemName").each(function(){
               
                if($(this).val() == itemName)
                {
                    $(this).siblings("#paymentItemNum").val(num).trigger("focusout");
                }

            });
            
        }

        var totaldin = 0;
        var totaleur = 0;

        $(this).parents("#paymentItems").find("div#paymentItem").each(function(){
            if(/Popust/i.test($(this).find("#paymentItemName").val()))// == "Popust")
            {
                totaldin -= +$(this).find("#paymentItemTotalDin").val();
                totaleur -= +$(this).find("#paymentItemTotalEuro").val();
            } else {
                totaldin += +$(this).find("#paymentItemTotalDin").val();
                totaleur += +$(this).find("#paymentItemTotalEuro").val();
            }
        });
        $(this).parents(".psgPayment").find("#totalDIN").val(totaldin);
        $(this).parents(".psgPayment").find("#totalEUR").val(totaleur);
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