<script type="text/javascript">
$(function(){

	$(".editableC").editable();
	
	var list = $(".trvlDealsDetails");
   	for (i = 0, len = list.length; i < len; i++){
        list[i].onclick=function(){
            $.ajax({
                url: 'travelDealDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    trvlDls_id: $(this)[0].name
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }

                    if (res.data != null) {
                        var trvldl = jQuery.parseJSON(res.data);
                        $(".modal-body #id")[0].setAttribute("value", trvldl.id);
                        $(".modal-body #category")[0].setAttribute("value", trvldl.category);
                        $(".modal-body #destination")[0].setAttribute("value", trvldl.destination);
                        $(".modal-body #organizer")[0].setAttribute("value", trvldl.organizer);
                        $(".modal-body #accom_type")[0].setAttribute("value", trvldl.accom_type);
                        $(".modal-body #accom_name")[0].setAttribute("value", trvldl.accom_name);
                        if(trvldl.transportation != null){
                            $(".modal-body #transportation")[0].setAttribute("value", trvldl.transportation);
                        }
                        if(trvldl.service != null){
                            $(".modal-body #service")[0].setAttribute("value", trvldl.service);
                        }
                        $(".modal-body #price_din")[0].setAttribute("value", trvldl.price_din);
                        if(trvldl.price_eur != null)
                            $(".modal-body #price_eur")[0].setAttribute("value", trvldl.price_eur);
                        }
                    }
            });
        };
    }
});
</script>

{{ $travel_deals->links() }}

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Kategorija</td>
			<td>Destinacija</td>
			<td>Tip Smeštaja</td>
			<td>Naziv Smeštaja</td>
			<td>Prevoz</td>
			<td>Usluga</td>
			<td>Cena (DIN)</td>
			<td>Cena (EUR)</td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@if ($travel_deals != null)
		@foreach ($travel_deals as $travel_deal)
		<tr>
			<td>
				{{ $travel_deal->category->name }}
			</td>
			<td>
				{{ $travel_deal->destination->name }}
			</td>
			<td>
				{{ $travel_deal->accomodationType }}
			</td>
			<td>
				{{ $travel_deal->accomodationName }}
			</td>
			<td>
				{{ $travel_deal->transportation }}
			</td>
			<td>
				{{ $travel_deal->service }}
			</td>
			<td>
				{{ $travel_deal->price_din }}
			</td>
			<td>
				{{ $travel_deal->price_eur }}
			</td>
			<td>
				<a class="trvlDealsDetails btn btn-primary pull-right" name="{{$travel_deal->id}}" role="button" data-toggle="modal" href="#trvlDlsDetailModal">
				<span class="icon-edit"></span>
			</td>
			<td>
				<a href="deleteTravelDeal/{{(string)$travel_deal->id}}" class="btn btn-danger pull-right">
				<span class="icon-trash"></span>
			</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>