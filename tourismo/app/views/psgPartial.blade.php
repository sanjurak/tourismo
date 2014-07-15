<script type="text/javascript">
$(function(){

	$(".editableC").editable();
	
	var list = $(".passangerDetails");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
			$.ajax({
                url: 'passangerDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    psg_id: $(this)[0].name
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }
                    $(".modal-body #gender")[0].value = "";

                    if (res.data != null) {
                        var psg = jQuery.parseJSON(res.data);
                        $(".modal-body #id")[0].setAttribute("value", psg.id);
                        $(".modal-body #name")[0].setAttribute("value", psg.name);
                        $(".modal-body #surname")[0].setAttribute("value", psg.surname);
                        $(".modal-body #address")[0].setAttribute("value", psg.address);
                        $(".modal-body #jmbg")[0].setAttribute("value", psg.jmbg);
                        if(psg.gender != null){
                            $(".modal-body #gender")[0].value = psg.gender;
                        }
                        if(psg.tel != null){
                            $(".modal-body #tel")[0].setAttribute("value", psg.tel);
                        }
                        if(psg.mob != null){
                            $(".modal-body #mob")[0].setAttribute("value", psg.mob);
                        }
                        if(psg.passport != null){
                            $(".modal-body #passport")[0].setAttribute("value", psg.passport);
                        }
                        if(psg.birth_date != null && psg.birth_date.toString() != "1970-01-01"
                            && psg.birth_date.toString() != "0000-00-00") {
                            var date = new Date(psg.birth_date);
    	                    $(".modal-body #birth_date").val(date.format("d-m-yyyy"));
    	            	}
                    };
                }
            });
		};
	}
});
</script>

{{ $passangers->links() }}

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Adresa</td>
			<!-- <td>Pol</td>
			<td>Telefon</td> -->
			<td>Mobilni</td>
			<!-- <td>Datum rođenja</td> -->
			<td>Broj Pasoša</td>
			<td>JMBG</td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@foreach ($passangers as $passanger)
	<tr>
		<td>
			{{ $passanger->name }}
		</td>
		<td>
			{{ $passanger->surname }}
		</td>
		<td>
			{{ $passanger->address }}
		</td>
		<!-- <td><a href="#" class="editableC" id="gender" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite pol putnika (m/f)">
			{{ $passanger->gender }}</a></td>
		<td><a href="#" class="editableC" id="tel" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite broj telefona putnika">
			{{ $passanger->tel }}</a></td>  -->
		<td>
			{{ $passanger->mob }}</td>
		<!-- <td><a href="#" class="editableC" id="birth_date" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite datum rođenja putnika (yyyy/mm/dd)">
			{{ $passanger->birth_date }}</a></td>  -->
		<td>
			{{ $passanger->passport }}</td>
		<td>
			{{ $passanger->jmbg }}
		</td>
		<td>
			<a class="passangerDetails btn btn-primary pull-right" name="{{$passanger->id}}" role="button" data-toggle="modal" href="#psgDetailModal">
			<span class="icon-edit"></span>
		</td>
		<td>
		@if (Passangers::canDelete($passanger->id))
			<a href="deletePassanger/{{(string)$passanger->id}}" class="btn btn-danger pull-right">
			<span class="icon-trash"></span>
		@endif
		</td>
	</tr>
	@endforeach
	</tbody>
</table>