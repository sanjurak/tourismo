$(function(){

	/*$("#newAccModal").hide();
	$("#editUnitsModal").hide();
	$("#addUnitModal").hide();
	*/
	$('#newAccModal .modal-body .btn').off('click');

	$("[rel='tooltip']").popover();

	$("#typeModNew").selectize({
		valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: true,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'typeListAcc',
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

	$(".nameUnitModNew").selectize({
		valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: true,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'typeUnitsListAcc',
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

	$("#newAccForm").validationEngine();

	$("#newAccForm").submit(function(event){
		event.preventDefault();

		var valid = $(this).validationEngine("validate");

		if(valid){
			counter = 0;
			$.ajax({
			url:"accommodationAdd",
			type:"POST",
			data:$(this).serialize(),
			success:function(data){
				window.location.href = "accommodation";
			},
			error:function(){
				alert("ERROR!");
			}

		});
		}
	
	});

	$("#newAccBtn").off("click");
	$("#newAccBtn").click(function(event){
		event.preventDefault();
		$("#newAccForm").trigger("submit");
	});

	$("#basicAcc").selectize({
				valueField: 'name',
		        labelField: 'name',
		        searchField: ['name'],
		        options: [],
		        create: false,
		        render: {
		            option: function(item, escape) {
		                return '<div>' +escape(item.name)+'</div>';
		            }
		        },
		        optgroups: [
		            {value: 'names', label: 'Naziv'},
		            {value: 'type', label: 'Tip smeštaja'},
		            {value: 'destination', label: 'Destinacija'}
		        ],
		        optgroupField: 'class',
		        optgroupOrder: ['name','type','destination'],
		        load: function(query, callback) {
		            if (!query.length) return callback();
		            $.ajax({
		                url: 'autocompleteACC',
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
		            //Search(query,"basicSearchOrg");
		        },
		        onChange: function(){
		            var term = this.items[0];
		            Search(term,"basicSearchAcc");
		        }
	});

	$("#bresetAcc").click(function(event){
		event.preventDefault();
		Search("*","basicSearchAcc");
	});

	$("#unitsId").hide();

	var counter = 0;

	$("#addUnit").click(function(e){
		e.preventDefault();
		var units = $(".hiddenUnit").clone(true);
		units.show().removeClass("hiddenUnit");
		units.find("#nameUnitModNew").attr("name","Unit["+counter+"][name]");
		units.find("#capacityUnitModNew").attr("name","Unit["+counter+"][capacity]");
		units.find("#numberUnitModNew").attr("name","Unit["+counter+"][number]");

		counter++;
		$(units).appendTo("#units");
	});

	$(".addUnit").off("click");
	$(".addUnit").click(function(event){
		event.preventDefault();
		$accid = $(this).attr("data-id");
		
		$("#addUnitModal").modal("show");
		$("#accId").val($accid);
		$("#addNewUnit").trigger("click");
	});

	$("#addNewUnit").off("click");
	$("#addNewUnit").click(function(event){
		event.preventDefault();
		var units = $(".hiddenUnit").clone(true);
		units.show().removeClass("hiddenUnit");
		units.find("#nameUnitModNew").attr("name","Unit["+counter+"][name]");
		units.find("#capacityUnitModNew").attr("name","Unit["+counter+"][capacity]");
		units.find("#numberUnitModNew").attr("name","Unit["+counter+"][number]");

		counter++;
		$(units).appendTo("#newunits");
	});

	$("#addUnitCanceled").click(function(event){
		event.preventDefault();
		
		$("#newunits").empty();
		$("#addUnitModal").modal("close");
	});

	$("#addUnitConfirmed").off("click");
	$("#addUnitConfirmed").click(function(event){
		event.preventDefault();
		
		$.ajax({
			url: "addUnits/" + $("#accId").val(),
			type: "POST",
			data: $("#newUnitsForm").serialize(),
			success:function(data)
			{
				window.location.href = "accommodation";
			},
			error: function(){

			}
		});
	});


	$("#deleteAccModal").hide();


	$("#removeUnit").click(function(event){
		event.preventDefault();

		$(this).parents("div#unitsId").remove();
	});

	$(".deleteAcc").click(function(event){
		event.preventDefault();

		var id = $(this).attr("data-id");
		$("#idDel").val(id);
		$("#deleteAccModal").modal("show");	
	});

	$("#deleteConfirmed").click(function(event){
		event.preventDefault();

		$.ajax({
			url: "accommodationDelete/"+$("#idDel").val(),
			type: "POST",
			success: function(data){
				window.location.href = "accommodation";
			},
			error: function(msg){
				alert("ERROR: "  + msg);
			}
		});
	});

	$("#deleteCanceled").click(function(event){
		event.preventDefault();
		$("#deleteAccModal").modal("close");
	});

	$(".unit").off("click");
	$(".unit").click(function(event){
		event.preventDefault();
		var accId = $(this).attr("acc-id");

		$.ajax({
			url: "unitsEdit/" + accId,
			type: "POST",
			dataType:"html",
			success: function(data)
			{
				$("#editModal").empty().html(data);
				$("#editUnitsModal").modal("show");
			},
			error: function(){
				alert("ERROR!");
			}
		});
	});

	$("#editSave").click(function(event){
		event.preventDefault();
		$.ajax({
			url: "unitsEditSave",
			type: "POST",
			data: $("#editUnitsForm").serialize(),
			success:function(data){
				window.location.href = "accommodation";
			},
			error: function(){

			}
		});
	});

	$("#editCancel").click(function(event){
		event.preventDefault();
		$("#editUnitsModal").modal("close");
	});

	$("closeNewAccModal").click(function(e){
		e.preventDefault();
		$("#units").empty();
		$("#newAccModal").modal("close");
	})
});