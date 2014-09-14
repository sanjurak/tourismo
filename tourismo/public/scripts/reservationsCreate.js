$(function(){
        	$("#traveldealNew").hide();
		$("#passangerNew").hide();
		$("#addCategoryModal").hide();
		$("#addOrganizerModal").hide();
		$("#addDestinationModal").hide();
		$("#addAccomodationModal").hide();
	
		$("#traveldealDetails input").prop("disabled", true);


	$("#addTravelDeal").click(function(event){
		event.preventDefault();
		$("#traveldealDetails").slideUp();
		$("#traveldealNew").slideToggle();

	});

	$("#btnAddTravelDeal").click(function(event){
		event.preventDefault();

		$.ajax({
			url:'addTravelDeal',
			type: 'POST',
			data: $("#traveldealNewForm").serialize(),
			success: function(data){
                $("#traveldealsSel")[0].selectize.addOption(data);
                // $("#traveldealsSel")[0].selectize.refreshOptions();
                // $("#traveldealNew").slideToggle();
                selectTravelDealItem(data);
			}
		});
	});

	$("#addCategoryBtn").click(function(e){
		e.preventDefault();
		var inputtext = $("#categorySel .selectize-input input[type=text]").val();
		if(inputtext != '') $("#addNewCategoryForm #name").val(inputtext);
		$("#addCategoryModal").modal("show");
	});

	$("#addNewCategory").click(function(){
		$.ajax({
			url: "newCategory",
			type: "POST",
			data: $("#addNewCategoryForm").serialize(),
			success: function(data)
			{
				$("#categorySel")[0].selectize.addOption(data);
                $("#categorySel")[0].selectize.refreshOptions();    
                $("#categorySel")[0].selectize.options[data.id].selected = true;
				$("#categorySel").siblings("div.selectize-dropdown").trigger("onOptionSelect");
				$("#addCategoryModal").modal("hide");
			}
		});
	});

	$("#categorySel").selectize({
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
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'categoriesRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#addDestinationBtn").click(function(e){
		e.preventDefault();
		$("#addDestinationModal").modal("show");
	});

	$("#addNewDestination").click(function(){
		$.ajax({
			url: "addDestination",
			type: "POST",
			data: $("#addNewDestinationForm").serialize(),
			success: function(data)
			{
				var dstSelectize = $("#destinationSel")[0].selectize;
				dstSelectize.addOption(data);
				dstSelectize.refreshOptions();
				dstSelectize.addItem(data.name);
				$("#addDestinationModal").modal("hide");
			}
		});
	});


	$("#destinationSel").selectize({
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
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'destinationsRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    acc: $("#accomodationSel")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#destinationAcc").selectize({
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
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'destinationsRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#addOrganizerBtn").click(function(e){
		e.preventDefault();
		$("#addOrganizerModal").modal("show");
	});

	$("#addNewOrganizer").click(function(e){
		e.preventDefault();

		$.ajax({
			url: "organizatorAdd",
			type: "POST",
			data: $("#addNewOrganizerForm").serialize(),
			success: function(data)
			{
				var orgSelectize = $("#organizerSel")[0].selectize;
				orgSelectize.addOption(data);
				orgSelectize.refreshOptions();
				orgSelectize.addItem(data.name);
				$("#addOrganizerModal").modal("hide");
			},
			error: function(){
				alert("Greska pri upisu u bazu");
			}
		});
	});

	$("#organizerSel").selectize({
		valueField: 'pib',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'organizersRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#unitsId").hide();

	var counter = 0;

	$("#addUnit").click(function(event){
		event.preventDefault();
		var units = $(".hiddenUnit").clone(true);
		units.show().removeClass("hiddenUnit");
		units.find("#nameUnitModNew").attr("name","Unit["+counter+"][name]").addClass("validate[required]");
		units.find("#capacityUnitModNew").attr("name","Unit["+counter+"][capacity]").addClass("validate[required]");
		units.find("#numberUnitModNew").attr("name","Unit["+counter+"][number]").addClass("validate[required]");

		counter++;
		$(units).appendTo("#units");
	});

	$("#removeUnit").click(function(event){
		event.preventDefault();

		$(this).parents("div#unitsId").remove();
	});

	$("#addAccomodationBtn").click(function(e){
		e.preventDefault();
		$("#addAccomodationModal").modal("show");
	});

	$("#addNewAccomodation").click(function(e){
		e.preventDefault();

		counter = 0;
		$.ajax({
			url:"accommodationAddRes",
			type:"POST",
			data:$("#addNewAccomodationForm").serialize(),
			success:function(data){
				var accSelectize = $("#accomodationSel")[0].selectize;
				accSelectize.addOption(data.data);
				accSelectize.refreshOptions();
				$("#addAccomodationModal").modal("hide");
			},
			error:function(){
				alert("ERROR!");
			}
		});
	});

	$("#accomodationSel").selectize({
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
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'accomodationsRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    dst: $("#destinationSel")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

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

            selectTravelDealItem(item);
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

        	addPassangerItem(item);
        }
	});

    $("#passangersDetails").on("click", ".remove-psg", function(e){
        e.preventDefault();
        var id = $(this).siblings(".passangers").val();
        if(confirm("Potvrdite brisanje podataka o putniku sa rezervacije"))
        {
            $(this).parents("div.psg-item").remove();
            $("#psgPaymentDetails div#" + id).find("#removeItem").each(function(){
                $(this).trigger("click");
            });
            $("#psgPaymentDetails div#" + id).remove();
        }
    });

        var itemCounter = 0;
        var psgItemCounter = 0;

    $("#removeItem").click(function(e){
        e.preventDefault();

        var dins = $(this).siblings("#paymentItemTotalDin").val();
        var euros = $(this).siblings("#paymentItemTotalEuro").val();

        if(/\bPopust\b/i.test($(this).siblings("#paymentItemName").val()))
        {
            var totaldin = +$(this).parents(".psgPayment").find("#totalDIN").val() + +$(this).siblings("#paymentItemTotalDin").val(); 
            var totaleuro = +$(this).parents(".psgPayment").find("#totalEUR").val() + +$(this).siblings("#paymentItemTotalEuro").val();
        
        }
        else
        {
            var totaldin = +$(this).parents(".psgPayment").find("#totalDIN").val() - +$(this).siblings("#paymentItemTotalDin").val(); 
            var totaleuro = +$(this).parents(".psgPayment").find("#totalEUR").val() - +$(this).siblings("#paymentItemTotalEuro").val();            
        }

        var itemName = $(this).siblings("#paymentItemName").val();
        var num = $(this).siblings("#paymentItemNum").val();

        if(!$(this).parents("div.psgPayment").hasClass("finalPayment"))
        {
            $(".finalPayment").find("#paymentItemName").each(function(){

                if($(this).val() == itemName)
                {
                    var numb = +$(this).siblings("#paymentItemNum").val() - num;
                    if(numb == 0)
                    {
                        var totEur = $(this).parents(".psgPayment").find("#totalEUR").val();
                        var totDin = $(this).parents(".psgPayment").find("#totalDIN").val();

                        if(/Popust/i.test(itemName))
                        {
                            $(this).parents(".psgPayment").find("#totalEUR").val(+totEur + +euros);
                            $(this).parents(".psgPayment").find("#totalDIN").val(+totDin + +dins);
                        }
                        else
                        {
                            $(this).parents(".psgPayment").find("#totalEUR").val(+totEur - +euros);
                            $(this).parents(".psgPayment").find("#totalDIN").val(+totDin - +dins);
                        }

                        $(this).parents("div#paymentItem").remove();
                    }
                    else
                    {                       
                        $(this).siblings("#paymentItemNum").val(numb).trigger("focusout");
                    }
                     
                }

            });            
        }

        $(this).parents(".psgPayment").find("#totalDIN").val(totaldin);
        $(this).parents(".psgPayment").find("#totalEUR").val(totaleuro);
        $(this).parents("div#paymentItem").remove();
    });

    $("#addPaymentItem").click(function(event){
        event.preventDefault(); 
        var items = $(".hiddenItem").clone(true);
        items.show().removeClass("hiddenItem");
        items.find("#paymentItemName").attr("name","Item["+itemCounter+"][name]").addClass("validate[required]").prop("readonly", true);
        items.find("#paymentItemEuro").attr("name","Item["+itemCounter+"][euro]").addClass("validate[required]").prop("readonly", true);
        items.find("#paymentItemDin").attr("name","Item["+itemCounter+"][din]").addClass("validate[required]").prop("readonly", true);
        items.find("#paymentItemNum").attr("name","Item["+itemCounter+"][num]").addClass("validate[required]").prop("readonly", true);
        items.find("#paymentItemTotalDin").attr("name","Item["+itemCounter+"][totaldin]").addClass("validate[required]").prop("readonly", true);
        items.find("#paymentItemTotalEuro").attr("name","Item["+itemCounter+"][totaleuro]").addClass("validate[required]").prop("readonly", true);
        items.find("#isExcursion").attr("name","Item["+itemCounter+"][isExcursion]").addClass("excursionChk");

        items.find("#removeItem").remove();
        itemCounter++;
        $(".finalPayment").find("#paymentItems").append(items);
    });

$("#addPsgPaymentItem").click(function(event){
        event.preventDefault();
        var items = $(".hiddenItem").clone(true);
        var id = $(this).parents(".psgPayment").attr("id");
        items.show().removeClass("hiddenItem").addClass("paymentItem");
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

    //$('#birth_datepicker input').click(function(event){
    //        event.preventDefault();
     //   });

//    $('#birth_datepicker input').datepicker({
//        format: "dd/mm/yyyy",
//        viewMode: 2
//    });

	$('#birth_date').datepicker();
	$('#birth_date').datepicker( "option", "dateFormat", "d-m-yy" );

    //$('#birth_datepicker span').click(function(){
    //   $('#birth_datepicker input').datepicker('show');
    //});

    $("#addNewPsg").click(function(event){
        event.preventDefault();
        if($("#passangerNew").is(":hidden")) {
//          $("#passangersDetails").slideUp();
            $("#passangerNew").slideDown();
        } else {
            $("#passangerNew").slideUp();
//          $("#passangersDetails").slideDown();
        }
    });

    $("#btnAddNewPsg").click(function(event){
        event.preventDefault();

        $.ajax({
            url:'addPassanger',
            type: 'POST',
            data: $("#passangerNewForm").serialize(),
            success: function(data){
                $("#passangerNew").slideUp();
                if (data.data) {           
	                addPassangerItem(data.data[0]);
                } else {
    	        	$("#notifications").append("<div class='alert alert-error alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4>Error</h4> Putnik sa tim JMBG već postoji! </div>");
    //	        	$("#passangersDetails").show();
    	        }
            }
        });
        
        $("#passangerNew").find("input").val("");
        $("#passangerNew #gender")[0].value = "";
    });

//    $('#start_datepicker input').datepicker({
//        format: "d-m-yy"
//    });

	$('#start_datepicker input').datepicker();
	$('#start_datepicker input').datepicker( "option", "dateFormat", "d-m-yy" );

//    $('#end_datepicker input').datepicker({
//        format: "dd/mm/yyyy",
//        viewMode: 2
//    });

	$('#end_datepicker input').datepicker();
	$('#end_datepicker input').datepicker( "option", "dateFormat", "d-m-yy" );

   // $("#end_datepicker span").click(function(){
   //   $('#end_datepicker input').datepicker("show");  
   // });


//    $('#travel_datepicker input').datepicker({
//        format: "dd/mm/yyyy",
//        viewMode: 2
//    });

	$('#travel_datepicker input').datepicker();
	$('#travel_datepicker input').datepicker( "option", "dateFormat", "d-m-yy" );

   // $("#travel_datepicker span").click(function(){
   //   $('#travel_datepicker input').datepicker("show");  
   // });

    $("#createReservationForm").validationEngine();
    $("#paymentDetailsForm").validationEngine();
    $("#passangersDetailsForm").validationEngine();

    $("#createReservationForm").submit(function(e){
       e.preventDefault();
       var internalChecked = $("#internal").is(":checked");
       var data = $("#createReservationForm").serialize() + "&" + $("#passangersDetailsForm").serialize() 
                + "&" + "Internal="+internalChecked;
       
       $(".psgPayment").each(function(){
            $(this).find("input:text").each(function(){
                data += "&"+$(this).attr("name") + "=" + $(this).val();
            });

            $(this).find("input:hidden").each(function(){
                data += "&"+$(this).attr("name") + "=" + $(this).val();
            });
            //data += "&" + $(this).find("#paymentItemPsgId").attr("name") + "=" +  $(this).find("#paymentItemPsgId").val();
       });

       $.each($(".excursionChk"), function(){
            data += "&"+$(this).attr("name") + "=" + $(this).is(":checked");
       });
       
     	data += "&ResNum=" + $("#resNum").val();

        $.ajax({
            url: "createReservation",
            type: "POST",
            data: data,
            success:function(data)
            {
                if(data.status == "success")
                    window.open('contract/' + data.id);
                  window.location.href = "reservations";
            },
            error: function(){

            }
        });

    });

    $("#createReservationBtn").click(function(e){
       e.preventDefault();
       if($("#passangersDetails").is(":empty"))
            $("#psgMessage").show();
       if($("#createReservationForm").validationEngine("validate") && $("#passangersDetailsForm").validationEngine("validate") && $("#paymentDetailsForm").validationEngine("validate"))
            $("#createReservationForm").trigger("submit");
        
    });
    
    $("#jmbg").focusout(function(){
    	var century = 1;
    	var d = 2;
    	var dd = 0;
    	var m = 2;
    	var mm = 2;
    	if ($("#jmbg")[0].value.substr(4,1) != '9')
    		century = 2;
    	if ($("#jmbg")[0].value.substr(0,1) == '0') {
    		d = 1;
    		dd = 1;
    	}
	if ($("#jmbg")[0].value.substr(2,1) == '0') {
    		m = 1;
    		mm = 3;
    	}
    	$("#birth_date")[0].value = $("#jmbg")[0].value.substr(dd,d)
    		+ '-' + $("#jmbg")[0].value.substr(mm,m)
    		+ '-' + century + $("#jmbg")[0].value.substr(4,3);
    });

    function selectTravelDealItem(item) {
        $("#traveldealNew").hide();

        $("#category").val(item["category"]["name"]);
        $("#organizer").val(item["organizer"]["name"]);
        $("#destination").val(item["destination"]["name"]);
        $("#accomodation").val(item["accomodation"]+" "+item["accomodation_unit"]["name"]+"/"+item["accomodation_unit"]["capacity"]);
        $("#transportation").val(item["transportation"]);
        $("#service").val(item["service"]);
        $("#traveldealId").val(item["id"]);

        $("#traveldealDetails").slideDown();

        TravelDealPriceDin = item["price_din"];
        TravelDealPriceEur = item["price_eur"];

       
        /*$("#addPaymentItem").trigger("click");
        $("#paymentItems div").last().find("#paymentItemEuro").val(item["price_eur"]).trigger("focusout");
        $("#paymentItems div").last().find("#paymentItemDin").val(item["price_din"]).trigger("focusout");
        $("#paymentItems div").last().find("#paymentItemName").val("Smeštaj Adl");
        $("#paymentItems div").last().find("#paymentItemNum").val("1");
        $("#paymentItems div").last().find("#paymentItemName").attr("data-val","Smeštaj Adl").prop("readonly", true);
    */
        $("#passangers_details").show();
        $("#payment_details").show();
    }

    function addPassangerItem(item) {
        $("<div class='psg-item'>"+item.passanger
                +"<input type='hidden' name='Passangers[" + psgCounter +"]' class='passangers' value='"+item.id+"'/>"
                +"<a href='#' class='remove-psg pull-right'>"
                +"<span class='icon icon-remove-sign'></span></a></div>")
            .appendTo("#passangersDetails");
            
        if(!$("#passangerNew").is(":hidden")) {
            $("#passangerNew").slideUp();
        }
        $("#passangersDetails").show();
        $("#details").show();
        $("#createReservationBtn").show();

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
