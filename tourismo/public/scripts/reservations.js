$(function(){

	$("#newReservation").click(function(event){
		event.preventDefault();

		$.ajax({
			url:"createReservation",
			type:'GET',
			success:function(data)
			{
				$("#reservations").empty().html(data);
			},
			error:function(){
				alert("ERROR");
			}
		});
	});

});