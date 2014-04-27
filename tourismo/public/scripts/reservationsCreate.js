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
		$("#traveldealNew").slideDown();

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
		units.find("#nameUnitModNew").attr("name","Unit["+counter+"][name]");
		units.find("#capacityUnitModNew").attr("name","Unit["+counter+"][capacity]");
		units.find("#numberUnitModNew").attr("name","Unit["+counter+"][number]");

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

        	$("#category").val(item["category"]["name"]);
				$("#organizer").val(item["organizer"]["name"]);
				$("#destination").val(item["destination"]["name"]);
				$("#accomodation").val(item["accomodation"]+" "+item["accomodation_unit"]["name"]+"/"+item["accomodation_unit"]["number"]);
				$("#transportation").val(item["transportation"]);
				$("#service").val(item["service"]);

				$("#traveldealDetails").slideDown();
        }
	});


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

        	$("<div>"+item.passanger+"</div>").appendTo("#passangersDetails");
        }
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
                selectize.addOption(data);
                selectize.refreshOptions();
                selectize.addItem(data.passanger);
            }
        })
    });
});