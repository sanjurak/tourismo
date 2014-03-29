function SearchPsg(term)
{
	$.ajax({
			url:"basicPsgSearch",
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				$("#passangersData").empty().html(data);
			}
		});
}

function SearchDst(term)
{
	$.ajax({
			url:"basicDstSearch",
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				$("#list_view").empty().html(data);
			}
		});
}

function ResetSearch(url, resetId)
{
	$.ajax({
			url:url,
			type:"GET",
			dataType:"html",
			success: function(data){
				$("#" + resetId).empty().html(data);
			}
		});
}

function AdvancedSearch(form)
{
	$data = form.serialize();
	$.ajax({
		url: 'advancedSearch',
		type: 'POST',
		data: form.serialize(),
		success: function(data)
		{
			$("#list_view").empty().html(data);
		}
	});
}

function NewDestination(form)
{
	$data = form.serialize();
	$.ajax({
		url: 'addDestination',
		type: 'POST',
		data: form.serialize(),
		success: function(data){
			window.location.href = 'destinations';
		},
		error:function(msg){
			alert("ERROR "+msg);
		}
	});
}