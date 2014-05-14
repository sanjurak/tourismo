@extends('reports\\memo')
@section('report')

<table class="content">
	<tr>
		<td class="textright" colspan='4' height='40'>Datum:</td><td colspan='2' height='40'>{{$payment->date}}</td>
	</tr>
	<tr>
		<td class="textcenter" colspan='5' height='60'><h2>PRIZNANICA br. {{$payment->id}}</h2></td>
	</tr>
	<tr>
		<td colspan='3'>Iznos dinarskog dela u dinarima:</td><td colspan='3'>{{$payment->amount_din}} din</td>
	</tr>
	<tr>
		<td colspan='3'>Iznos deviznog dela u dinarima:</td><td colspan='3'>{{$payment->amount_eur_din}} din</td>
	</tr>
	<tr>
		<td colspan='3'>Primljeno od:</td><td colspan='3'>{{$passanger->name}} {{$passanger->surname}}, {{$passanger->jmbg}}</td>
	</tr>
	<tr>
		<td colspan='3'>Na ime:</td><td colspan='3'>Uplata dugovanja po ugovoru br. {{$reservation->reservation_number}}</td>
	</tr>
	<tr>
		<td style="vertical-align:bottom;" colspan='2' height='80'>Isplatio</td><td style="vertical-align:bottom;" colspan='2' height='80'>Overava</td><td style="vertical-align:bottom;" colspan='2' height='80'>Primio</td>
	</tr>
	<tr>
		<td colspan='2' height='40'>_____________________</td><td colspan='2' height='40'>_____________________</td><td colspan='2' height='40'>_____________________</td>
	</tr>
</table>

@endsection