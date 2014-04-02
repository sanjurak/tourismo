$(document).ready(function(){

	$("#editOrgModal").hide();
	$("#newOrgModal").hide();
	$("#deleteOrgModal").hide();

	$(".editOrg").click(function(event){

		event.preventDefault();

		//id reda u tabeli kome pripada objekat za editovanje (id je pib)
		var id = $(this).attr("data-id");

		//na osnovu pib-a pribavljaju se trenutne vrednosti atributa organizatora
		var pib = $("#" + id).find("#pib").text();
		var matbr = $("#" + id).find("#mat_br").text();
		var name = $("#" + id).find("#name").text();
		var address = $("#" + id).find("#address").text();
		var phone = $("#" + id).find("#phone").text();
		var web = $("#" + id).find("#web").text();
		var email = $("#" + id).find("#email").text();
		
		//upisivanje trenutnih vrednosti u modal dialog formu
		$("#pibMod").val(pib);
		$("#mat_brMod").val(matbr);
		$("#nameMod").val(name);
		$("#addressMod").val(address);
		$("#phoneMod").val(phone);
		$("#webMod").val(web);
		$("#emailMod").val(email);
		

		//otvaranje edit forme u modal dialogu
		$("#editOrgModal").modal("show");
	});

	$("#closeOrgModal").click(function(event){
		event.preventDefault();
		$("#editOrgModal").modal("close");
	});

	$("#editOrgForm").validationEngine();


	$("#editOrgForm").submit(function(event){
			event.preventDefault();
	        var valid = $(this).validationEngine("validate");
	        if(valid)
	        {
	        	$.ajax({
					url: "organizatorEditAll/" + $("#pibMod").val(),
					type: "POST",
					data: $(this).serialize(),
					success: function(data){
						window.location.href = "organizators";
					},
					error: function(msg){
						alert("ERROR: "  + msg);
					}
				});
	        }
	});


	$("#newOrgForm").validationEngine();


	$("#newOrgForm").submit(function(event){
			event.preventDefault();
	        var valid = $(this).validationEngine("validate");
	        if(valid)
	        {
	        	$.ajax({
					url: "organizatorAdd",
					type: "POST",
					data: $(this).serialize(),
					success: function(data){
						window.location.href = "organizators";
					},
					error: function(msg){
						alert("ERROR: "  + msg);
					}
				});
	        }
	});


	$("#editOrgBtn").click(function(){
	    $("#editOrgForm").trigger('submit');
	});

	$("#newOrgBtn").click(function(){
	    $("#newOrgForm").trigger('submit');
	});

	$(".deleteOrg").click(function(event){
		event.preventDefault();

		//id objekaa za brisanje (id je pib)
		var id = $(this).attr("data-id");
		$("#pibDel").val(id);
		$("#deleteOrgModal").modal("show");		

	});

	$("#deleteOrgConfirmed").click(function(event){
			event.preventDefault();
			

			$.ajax({
			url: "organizatorDelete/" + $("#pibDel").val(),
			type: "POST",
			success: function(data){
				window.location.href = "organizators";
			},
			error: function(msg){
				alert("ERROR: "  + msg);
			}
			});
	});

	$("#closeDelOrg").click(function(event){
		event.preventDefault();
		$("#deleteOrgModal").modal("close");
	});
});
