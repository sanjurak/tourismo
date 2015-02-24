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

function SearchExcursions(cat, dst, from, to)
{
	$.ajax({
		url: 'basicExcursionsSearch',
		type: 'POST',
		data: {
			cat_item: cat,
			dst_item: dst,
			from_item: from,
			to_item: to
		},
		dataType: 'html',
		success: function(data){
			$('#excursionsData').empty().html(data);
		}
	});
}

function SearchPassangers(cat, dst, from, to)
{
	$.ajax({
		url: 'basicPsgForPeriodSearch',
		type: 'POST',
		data: {
			cat_item: cat,
			dst_item: dst,
			from_item: from,
			to_item: to
		},
		dataType: 'html',
		success: function(data){
			$('#passangersData').empty().html(data);
		}
	});
}

function SearchPayments(term)
{
	$.ajax({
			url:"basicPaymentsSearch",
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				$("#paymentsData").empty().html(data);
			}
		});
}

function Search(term, url)
{
	$.ajax({
			url:url,
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				$("#list_view").empty().html(data);
			}
		});
}

function SearchTrvlDls(cat, dst)
{
	$.ajax({
		url: 'basicTrvlDlsSearch',
		type: 'POST',
		data: {
			cat_item: cat,
			dst_item: dst
		},
		dataType: 'html',
		success: function(data){
			$('#list_view').empty().html(data);
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

function AdvancedSearch(form, url)
{
	var data = form.serialize();
	$.ajax({
		url: url,
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

function EditOrganizator(form)
{
	$,ajax({
		url: "organizatorEditAll",
		type: "POST",
		data: form.serialize(),
		success: function(data){
			window.location.href = "organizators";
		},
		error: function(msg){
			alert("ERROR: "  + msg);
		}
	});
}
}