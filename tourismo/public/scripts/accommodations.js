$(function(){

	$("#newAccModal").hide();

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

	$("#deleteAccModal").hide();
});