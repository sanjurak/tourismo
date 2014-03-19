$(document).ready(function(){

	$(".editableC").editable();
	$("#advancedSearch").hide();

	$("#advanced").click(function(){
		$("#advancedSearch").slideDown();
	});

	$("#breset").click(function(){
		$("#basic").val('');		
	});
});