<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
{{HTML::style('styles/reports.css')}}
</head>
<body>
<table class="memo">
	<tr>
		<td class="width60"><img height="150" src="images/clock_logo.png" /></td>
		<td class="textleft font10 width40">
			<p><b>
				CLOCK TRAVEL d.o.o.<br>
				Adresa: Trg Republike 6, Niš<br>
				mob: +381 66 00 555 6<br>
				tel: +381 18 505 435<br>
				<br>
				www.clocltravel.rs<br>
				email: office@clocktravel.rs<br>
				<br>
				Licenca .....<br>
				Matični broj: ....<br>
				PIO: .... <br>
				Žiro račun: .... <br>
				</b>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
</table>
@yield("report")
</body>
</html>