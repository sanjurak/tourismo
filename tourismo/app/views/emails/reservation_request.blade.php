@extends('reports//memo')
@section('report')

<table class="content">
	<tr class="font14">
		<td class="textcenter" colspan="4"><p><b>ZAHTEV ZA REZERVACIJOM br. {{$reservation->reservation_number}}</b></p></td>
	</tr>
</table>
<table border='1' width="50%">
	<tr class="font14" valign="middle">
		<td class="textcenter" bgcolor="LightGray" colspan='1'>
			<p><b>ORGANIZATOR PUTOVANJA:</b></p>
		</td>
		<td class="textcenter" colspan='1'>
			<p>{{$organizer->name}}</p>
		</td>
	</tr>
</table>
<br/>
<table>
	<tr valign="bottom" rowspan='2'>
		<td colspan='4'>
			<b>MOLIMO POTVRDU SLEDEĆEG ARANŽMANA:</b>
		</td>
	</tr>
</table>
<table border='1' width="100%">
	<tr valign="middle">
		<td class="textcenter" bgcolor="LightGray">
			<b>DRŽAVA</b>
		</td>
		<td class="textcenter">
			{{$destination->country}}
		</td>
		<td class="textcenter" bgcolor="LightGray">
			<b>TIP SOBE</b>
		</td>
		<td class="textcenter">
			{{$accomodation_unit->name.' 1/'.$accomodation_unit->capacity}}
		</td>
	</tr>
	<tr valign="middle">
		<td class="textcenter" bgcolor="LightGray">
			<b>GRAD</b>
		</td>
		<td class="textcenter">
			{{$destination->town}}
		</td>
		<td class="textcenter" bgcolor="LightGray">
			<b>USLUGE</b>
		</td>
		<td class="textcenter">
			{{$travel_deal->service}}
		</td>
	</tr>
	<tr valign="middle">
		<td class="textcenter" bgcolor="LightGray">
			<b>HOTEL/APP/STD</b>
		</td>
		<td class="textcenter">
			{{$accomodation->type.' '.$accomodation->name}}
		</td>
		<td class="textcenter" bgcolor="LightGray">
			<b>BROJ OSOBA</b>
		</td>
		<td class="textcenter">
			{{$passangers_count}}
		</td>
	</tr>
	<tr valign="middle">
		<td class="textcenter" bgcolor="LightGray">
			<b>PERIOD OD-DO</b>
		</td>
		<td class="textcenter">
			{{date("d.m.y", strtotime($reservation->start_date)).'-'.date("d.m.y", strtotime($reservation->end_date))}}
		</td>
		<td class="textcenter" bgcolor="LightGray">
			<b>PREVOZ</b>
		</td>
		<td class="textcenter">
			{{$travel_deal->transportation}}
		</td>
	</tr>
</table>
<br/>
<table border='1' width="100%">
	<tr bgcolor="LightGray">
		<th>R. BR.</th>
		<th>KORISNIK ARANŽMANA</th>
		<th>DATUM ROĐENJA</th>
		<th>BROJ PASOŠA</th>
		<th>BROJ TELEFONA</th>
	</tr>
	@foreach($passangers as $i => $passanger)
		<tr>
			<td class="textcenter" bgcolor="LightGray">
				{{++$i.'.'}}
			</td>
			<td class="textcenter">
				{{$passanger->name.' '.$passanger->surname}}
			</td>
			<td class="textcenter">
				{{date("d.m.y", strtotime($passanger->birth_date))}}
			</td>
			<td class="textcenter">
				{{$passanger->passport}}
			</td>
			<td class="textcenter">
				{{$passanger->mob}}
			</td>
		</tr>
	@endforeach
</table>
<br/>
<table>
	<tr valign="bottom" rowspan='2'>
		<td colspan='4'>
			<b>NAPOMENA: </b>
			<p class="res-req-note">{{$}}</p>
		</td>
	</tr>
</table>
<table border='1' width="100%">
	<tr rowspan='3'>
		<td><br><br><br></td>
	</tr>
</table>
<p>
	<b>Molimo Vas da potvrdu sa predračunom prosledite na naš mail: office@clocktravel.rs</b>
</p>
<br>
<p>
	Datum: {{date("d.m.y")}}
</p>
@endsection