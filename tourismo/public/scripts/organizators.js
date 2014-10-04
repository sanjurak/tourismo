$(document).ready(function(){

	$("#editOrgModal").hide();
	$("#newOrgModal").hide();
	$("#deleteOrgModal").hide();

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

	$("#deleteConfirmed").click(function(event){
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

	$("#deleteCanceled").click(function(event){
		event.preventDefault();
		$("#deleteOrgModal").modal("close");
	});
});
