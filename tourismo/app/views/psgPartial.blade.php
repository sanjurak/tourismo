{{HTML::script('scripts/passangers.js')}}
<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>

<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Adresa</td>
			<!-- <td>Pol</td>
			<td>Telefon</td>
			<td>Mobilni</td>
			<td>Datum rođenja</td>
			<td>Broj Pasoša</td>
			 -->
			<td>JMBG</td>
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
			{{ $passanger->tel }}</a></td>
		<td><a href="#" class="editableC" id="mob" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite broj mobilnog putnika">
			{{ $passanger->mob }}</a></td>
		<td><a href="#" class="editableC" id="birth_date" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite datum rođenja putnika (yyyy/mm/dd)">
			{{ $passanger->birth_date }}</a></td>
		<td><a href="#" class="editableC" id="passport" data-type="text" data-pk= {{$passanger->id}} data-url="/passangerEdit/{{$passanger->id}}" data-title="Unesite broj pasoša putnika">
			{{ $passanger->passport }}</a></td>  -->
		<td>
			{{ $passanger->jmbg }}
		</td>
		<td>
			<a href="deletePassanger/{{(string)$passanger->id}}" class="btn btn-primary pull-right">
			<span class="icon-trash"></span>
		</td>
		<td>
			<a class="passangerDetails btn btn-primary pull-right" name="{{$passanger->id}}" role="button" data-toggle="modal" href="#psgDetailModal">
			<span class="icon-edit"></span>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>

