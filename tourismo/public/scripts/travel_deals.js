$(document).ready(function(){

	$("#categoriesSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        preload: true,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        optgroups: [
            {value: 'categories', label: 'Kategorija'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['categories'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteTrvlDlsCat',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    dst: $("#dstCountryTownSelect")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            var term = this.items[0];
            SearchTrvlDls(term, $("#dstCountryTownSelect")[0].value);
        }
    });

	$("#dstCountryTownSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        preload: true,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        optgroups: [
            {value: 'destination', label: 'Destinacija'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['destinations'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteTrvlDlsDst',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    cat: $("#categoriesSelect")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            var term = this.items[0];
            SearchTrvlDls( $("#categoriesSelect")[0].value, term);
        }
    });

	$("#bresetTrvlDls").click(function(){
        var selectize = $("#categoriesSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        selectize = $("#dstCountryTownSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        SearchTrvlDls("", "");        
    });

	
    $("#addNewTrvlDeal").click(function(){
        if ($("#traveldealNew").is(":visible"))
            $("#traveldealNew").slideUp(); 
        else
            $("#traveldealNew").slideDown();        
    });
    
    $("#btnAddTravelDeal").click(function(event){
		event.preventDefault();

		$.ajax({
			url:'addTravelDeal',
			type: 'POST',
			data: $("#traveldealNewForm").serialize(),
			success: function(data){
                		if ($("#traveldealNew").is(":visible"))
            				$("#traveldealNew").slideUp();
            			SearchTrvlDls("", "");
			}
		});
	});

    $("#dstCountryTownSelect").click(function(){
        var selectize = $('#dstCountryTownSelect')[0].selectize;
        selectize.load();
    });

    $("#addNewTrvlDlsForm").validationEngine();

    $("#addNewTrvlDlsForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
    });

    $( "#accordion" ).accordion({
      collapsible: true
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
	
	$("#traveldealDetails").hide();
	$("#traveldealNew").hide();
	$("#addCategoryModal").hide();
	$("#addOrganizerModal").hide();
	$("#addDestinationModal").hide();
	$("#addAccomodationModal").hide();
	$("#trvlDlsDetailModal").hide();

	
	$("#addCategoryBtn").click(function(){
		$("#addCategoryModal").modal("show");
	});
	$("#addDestinationBtn").click(function(){
		$("#addDestinationModal").modal("show");
	});
	$("#addOrganizerBtn").click(function(){
		$("#addOrganizerModal").modal("show");
	});
	$("#addAccomodationBtn").click(function(){
		$("#addAccomodationModal").modal("show");
	});
	
	//$("#addAccomodationBtn").click(function(e){
	//	e.preventDefault();
	//	$("#addAccomodationModal").modal("show");
	//});
});