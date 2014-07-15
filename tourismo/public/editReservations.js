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
        format: "dd/mm/yyyy",
        viewMode: 2,
        autoclose: true
    });
    
     $("#passangersDetails").on("click", ".remove-psg", function(e){
        e.preventDefault();
        $(this).parents("div.psg-item").remove();
    });
    
     $("#passangersDetails").on("click", ".delete-psg", function(e){
        e.preventDefault();
        $(this).siblings("#psgDelete").val("1");
        $(this).siblings("#psgId").removeClass("passanger");
        $(this).parents("div.psg-item").addClass("psgDeleted");
        $(this).siblings(".undo-psg").show();
        $(this).hide();
    });
    
     $("#passangersDetails").on("click", ".undo-psg", function(e){
        e.preventDefault();
        $(this).siblings("#psgDelete").val("0");
        $(this).siblings("#psgId").addClass("passanger");
        $(this).parents("div.psg-item").removeClass("psgDeleted");
        $(this).siblings(".delete-psg").show();
        $(this).hide();
    });

    $("#start_datepicker span").click(function(){
      $('#start_datepicker input').datepicker("show");  
    });


    $('#end_datepicker input').datepicker({
        format: "dd/mm/yyyy",
        viewMode: 2,
        autoclose: true
    });

    $("#end_datepicker span").click(function(){
      $('#end_datepicker input').datepicker("show");  
    });


    $('#travel_datepicker input').datepicker({
        format: "dd/mm/yyyy",
        viewMode: 2,
        autoclose: true
    });

    $("#travel_datepicker span").click(function(){
      $('#travel_datepicker input').datepicker("show");  
    });
    
      $("#editReservationForm").validationEngine();
      $("#passangersDetailsForm").validationEngine();
      $("#generalInfo").validationEngine();
      
      $("#editReservationForm").submit(function(e){
       e.preventDefault();
       
       var data = $("#editReservationForm").serialize() + "&" + $("#passangersDetailsForm").serialize() + "&" + $("#generalInfo").serialize();
       
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
       if(!($(".psg-item").has(".passanger"))
       {
            $("#psgMessage").show();
            return;
        }
       if($("#editReservationForm").validationEngine("validate") && $("#passangersDetailsForm").validationEngine("validate") && $("#generalInfo").validationEngine("validate"))
            $("#editReservationForm").trigger("submit");
        
    });
});