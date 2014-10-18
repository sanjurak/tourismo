<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{HTML::style('styles/reports.css')}}
</head>
<body>

@include('reports//memo_min')
<table style="width:100%">
	<tr>
		<td class="textright" colspan='4'>Datum:</td><td colspan='2'>{{$payment->date}}</td>
	</tr>
	<tr>
		<td class="textcenter" colspan='6' height='25'><h2>PRIZNANICA br. {{$payment->id}}@if($payment->fiscal_slip) po fiskalnom isečku br. {{$payment->fiscal_slip}}@endif</h2></td>
	</tr>
	<tr>
		<td colspan='3'>Iznos dinarskog dela u dinarima:</td><td colspan='3'>{{number_format("$payment->amount_din",2)}} din</td>
	</tr>
	<tr>
		<td colspan='3'>Iznos deviznog dela u dinarima:</td>
		<td colspan='2'>{{number_format("$payment->amount_eur_din",2)}} din</td>
		<td>Po kursu: {{number_format("$payment->exchange_rate",2)}}</td>
	</tr>
	<tr>
		<td colspan='3'>Primljeno od:</td><td colspan='3'>{{$passanger->name}} {{$passanger->surname}}, {{$passanger->jmbg}}</td>
	</tr>
	<tr>
		<td colspan='3'>Na ime:</td><td colspan='3'>Uplata dugovanja po ugovoru br. {{$reservation->reservation_number}}</td>
	</tr>
	<tr>
		<td style="vertical-align:bottom;" colspan='3' height='20'>   Isplatio</td><td style="vertical-align:bottom;" colspan='2' height='20'>Primio   </td>
	</tr>
	<tr>
		<td colspan='3' height='30' style="margin-bottom:25px">_____________________</td><td colspan='2' height='30' style="margin-bottom:25px">_____________________</td>
	</tr>
</table>
<div style="height:33px;"></div>

@include('reports//memo_min')
<table style="width:100%">
	<tr>
		<td class="textright" colspan='4'>Datum:</td><td colspan='2'>{{$payment->date}}</td>
	</tr>
	<tr>
		<td class="textcenter" colspan='5' height='25'><h2>PRIZNANICA br. {{$payment->id}}@if($payment->fiscal_slip) po fiskalnom isečku br. {{$payment->fiscal_slip}}@endif</h2></td>
	</tr>
	<tr>
		<td colspan='3'>Iznos dinarskog dela u dinarima:</td><td colspan='3'>{{number_format("$payment->amount_din",2)}} din</td>
	</tr>
	<tr>
		<td colspan='3'>Iznos deviznog dela u dinarima:</td>
		<td colspan='2'>{{number_format("$payment->amount_eur_din",2)}} din</td>
		<td>Po kursu: {{number_format("$payment->exchange_rate",2)}}</td>
	</tr>
	<tr>
		<td colspan='3'>Primljeno od:</td><td colspan='3'>{{$passanger->name}} {{$passanger->surname}}, {{$passanger->jmbg}}</td>
	</tr>
	<tr>
		<td colspan='3'>Na ime:</td><td colspan='3'>Uplata dugovanja po ugovoru br. {{$reservation->reservation_number}}</td>
	</tr>
	<tr>
		<td style="vertical-align:bottom;" colspan='3' height='20'>   Isplatio</td><td style="vertical-align:bottom;" colspan='2' height='20'>Primio   </td>
	</tr>
	<tr>
		<td colspan='3' height='30' style="margin-bottom:25px">_____________________</td><td colspan='2' height='30' style="margin-bottom:25px">_____________________</td>
	</tr>
</table>
<div style="height:33px;"></div>
@include('reports//memo_min')
<table style="width:100%">
	<tr>
		<td class="textright" colspan='4'>Datum:</td><td colspan='2'>{{$payment->date}}</td>
	</tr>
	<tr>
		<td class="textcenter" colspan='5' height='25'><h2>PRIZNANICA br. {{$payment->id}}@if($payment->fiscal_slip) po fiskalnom isečku br. {{$payment->fiscal_slip}}@endif</h2></td>
	</tr>
	<tr>
		<td colspan='3'>Iznos dinarskog dela u dinarima:</td><td colspan='3'>{{number_format("$payment->amount_din",2)}} din</td>
	</tr>
	<tr>
		<td colspan='3'>Iznos deviznog dela u dinarima:</td>
		<td colspan='2'>{{number_format("$payment->amount_eur_din",2)}} din</td>
		<td>Po kursu: {{number_format("$payment->exchange_rate",2)}}</td>
	</tr>
	<tr>
		<td colspan='3'>Primljeno od:</td><td colspan='3'>{{$passanger->name}} {{$passanger->surname}}, {{$passanger->jmbg}}</td>
	</tr>
	<tr>
		<td colspan='3'>Na ime:</td><td colspan='3'>Uplata dugovanja po ugovoru br. {{$reservation->reservation_number}}</td>
	</tr>
	<tr>
		<td style="vertical-align:bottom;" colspan='3' height='20'>   Isplatio</td><td style="vertical-align:bottom;" colspan='2' height='20'>Primio   </td>
	</tr>
	<tr>
		<td colspan='3' height='30'>_____________________</td><td colspan='2' height='30'>_____________________</td>
	</tr>
</table>

</body>
</html>