$(function(){
		$("#traveldealDetails").hide();
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
				$("#traveldealNew").slideUp();
				var selectize = $("#traveldealsSel")[0].selectize;
				selectize.addOption(data);
				selectize.refreshOptions();
				selectize.addItem(data.name);
			}
		})
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

            $("#traveldealNew").hide();

        	$("#category").val(item["category"]["name"]);
				$("#organizer").val(item["organizer"]["name"]);
				$("#destination").val(item["destination"]["name"]);
				$("#accomodation").val(item["accomodation"]+" "+item["accomodation_unit"]["name"]+"/"+item["accomodation_unit"]["number"]);
				$("#transportation").val(item["transportation"]);
				$("#service").val(item["service"]);
                $("#traveldealId").val(item["id"]);

				$("#traveldealDetails").slideDown();

                $("#addPaymentItem").trigger("click");
                $("#paymentItems div").last().find("#paymentItemEuro").val(item["price_eur"]).trigger("focusout");
                $("#paymentItems div").last().find("#paymentItemDin").val(item["price_din"]).trigger("focusout");
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

    $("#passangersDetails").on("click", ".remove-psg", function(e){
        e.preventDefault();
        $(this).parents("div.psg-item").remove();
    });

        var itemCounter = 0;
    $("#removeItem").click(function(e){
        e.preventDefault();
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

       var val = +$("#totalEUR").val() + total;
       $("#totalEUR").val(val);
    });  

    $(".dinItem").focusout(function(){
        var total = $(this).val() * $(this).siblings("#paymentItemNum").val();
       $(this).siblings("#paymentItemTotalDin").val(total);

       var val = +$("#totalDIN").val() + total;
       $("#totalDIN").val(val);
    });   

    $(".numItem").focusout(function(){
        $(this).siblings(".euroItem").trigger("focusout");
        $(this).siblings(".dinItem").trigger("focusout");
    });    

    $('#birth_datepicker input').click(function(event){
            event.preventDefault();
        });

    $('#birth_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
    });

    $('#birth_datepicker span').click(function(){
       $('#birth_datepicker input').datepicker('show');
    });

    $("#addNewPsg").click(function(event){
        event.preventDefault();
        if($("#passangerNew").is(":hidden")) {
            $("#passangersDetails").slideUp();
            $("#passangerNew").slideDown();
        } else {
            $("#passangerNew").slideUp();
            $("#passangersDetails").slideDown();
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
                var selectize = $("#passangersSel")[0].selectize;
                selectize.addOption(data.data);
                selectize.refreshOptions();
                selectize.addItem(data.passanger);
            }
        })
    });

    $('#start_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
    });

    $("#start_datepicker span").click(function(){
      $('#start_datepicker input').datepicker("show");  
    });


    $('#end_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
    });

    $("#end_datepicker span").click(function(){
      $('#end_datepicker input').datepicker("show");  
    });


    $('#travel_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
    });

    $("#travel_datepicker span").click(function(){
      $('#travel_datepicker input').datepicker("show");  
    });

    $("#createReservationForm").validationEngine();
    $("#paymentDetailsForm").validationEngine();
    $("#passangersDetailsForm").validationEngine();

    $("#createReservationForm").submit(function(e){
       e.preventDefault();
       var internalChecked = $("#internal").is(":checked");
       var data = $("#createReservationForm").serialize() + "&" + $("#passangersDetailsForm").serialize() + "&" + $("#paymentDetailsForm").serialize() + "&Internal="+internalChecked;
       
       $.each($(".excursionChk"), function(){
            data += "&"+$(this).attr("name") + "=" + $(this).is(":checked");
       });

        $.ajax({

            url: "createReservation",
            type: "POST",
            data: data,
            success:function(data)
            {
                alert(data);
                 // window.location.href = "reservations";
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
});