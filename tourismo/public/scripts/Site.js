$(document).ready(function(){

	$(".editableC").editable();
	$("#advancedSearch").hide();

	$("#advanced").click(function(){
		$("#advancedSearch").slideDown();
	});

	$("#breset").click(function(){
		$("#basic").val('');		
	});

	$("#bsearch").click(function(){
		var term = $("#basic").val();
		$.ajax({
			url:"basicSearch",
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				alert(data);
				$("#list_view").empty().html(data);
			}
		});
	});
});