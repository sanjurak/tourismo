<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { 
  	font-family: DejaVu Sans, sans-serif; 
  	font-size: 11px;
  }

.width60{
	width:60%;
}

.width40{
	width: 40%;
}
  .font10{
  	font-size: 10px;
  }

  .memo{
  	width:100%;
  }

  .content{
  	width:100%;
  }

  .content td{
  	padding: 5px;
  }

  .textcenter{
  	text-align:center;
  }

  .textleft{
  	text-align:left;
  }

  .textright{
  	text-align:right;
  }

  table.borders, table.borders td{
  	border-collapse: collapse;
  	border: 1px solid gray;
  }

.valigncenter{
	vertical-align: middle;
}
  .signature{
  	width:33%;
  }

  .stamp{
  	width:200px;
  }
</style>
</head>
<body>
	{{-- */
		$passanger = $reservation->passanger;
		$traveldeal = $reservation->traveldeal;
		$organizer = $traveldeal->organizer;
		$destination = $traveldeal->destination;
		$accunit = $traveldeal->accomodationUnit;
		$accommodation = Accomodations::find($accunit->accommodations_id);
		$prices = $reservation->prices;
		$psg_count = $passangers->count() == 0 ? 1 : $passangers->count();
	/* --}}

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
<table class="content">
	<tr>
		<td class="textcenter"><b>UGOVOR O PUTOVANJU br. {{$reservation->reservation_number}}</b></td>
	</tr>
	<tr>
		<td class="textcenter">
			<b>Organizator putovanja:</b> {{$organizer->name}}
		</td>
	</tr>
	<tr>
		<td>
			Ugovor načinjen dana {{date("d/m/Y")}} između "Clock Travel" D.O.O. iz Niša, ul. Trg republike br. 6, koga zastupa Andrija Miličić, direktor, (u daljem tekstu - subagent, s jedne strane) i {{$passanger->name." ".$passanger->surname}} (u daljem tekstu - korisnik usluga/ugovarač, sa druge strane) iz Niša, ul. {{$passanger->address}}, tel. {{$passanger->tel}}, mob. {{$passanger->mob}}.
		</td>
	</tr>
	<tr>
		<td>
			<b>Ugovorene strane su se sporazumele o sledećem:</b>
		</td>
	</tr>
</table>

<table class="content borders">
	<tr>
		<td><b>Mesto:</b></td>
		<td>{{$destination->town .", ".$destination->country}}</td>
		<td><b>Naziv hotela/APP:</b></td>
		<td>{{$accommodation->type ." ". $accommodation->name}}</td>
	</tr>
	<tr>
		<td><b>Period boravka:</b></td>
		<td>{{$reservation->start_date ." - ".$reservation->end_date}}</td>
		<td><b>Dužina boravka:</b></td>
		<td>{{$reservation->nights_num ." noći"}}</td>
	</tr>
	<tr>
		<td><b>Broj putnika:</b></td>
		<td>{{$passangers->count() == 0 ? 1 : $passangers->count()}}</td>
		<td><b>Tip sobe STD/APP:</b></td>
		<td>{{$accunit->name}}</td>
	</tr>
	<tr>
		<td><b>Prevoz:</b></td>
		<td>{{$traveldeal->transportation}}</td>
		<td><b>Broj sobe STD/APP:</b></td>
		<td></td>
	</tr>
	<tr>
		<td><b>Viza:</b></td>
		<td></td>
		<td><b>Usluga:</b></td>
		<td>{{$traveldeal->service}}</td>
	</tr>
	<tr>
		<td><b>Osiguranje:</b></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>

<table class="content">
	<tr>
		<td>
			<b>Korisnik usluga se obavezuje da plati aranžman prema sledećem obračunu:</b>
		</td>
	</tr>
</table>

<table class="content borders textcenter">
	<tr>
		<td>OBRAČUN</td>
		<td>Po osobi (&euro;)</td>
		<td></td>
		<td>Po osobi (din)</td>
		<td></td>
		<td>Broj osoba</td>
		<td></td>
		<td>IZNOS (din)</td>
		<td></td>
		<td>IZNOS (&euro;)</td>
	</tr>
	@foreach($prices as $price)
		<tr>
		<td>{{$price->priceItem}}</td>
		<td>{{$price->priceEur}}</td>
		<td>X</td>
		<td>{{$price->priceDin}}</td>
		<td>X</td>
		<td>{{$psg_count}}</td>
		<td>X</td>
		<td>{{$price->priceDin * $psg_count}}</td>
		<td>=</td>
		<td>{{$price->priceEur * $psg_count}}</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="6" class="textright">Ukupno:</td>
		<td>DIN</td>
		<td>{{$prices->sum('priceDin')}}</td>
		<td>EUR</td>
		<td>{{$prices->sum('priceEur')}}</td>
	</tr>
</table>

<table class="content">
	<tr>
		<td>
			<p><b>NAPOMENA:</b></p>
			<p>
				<b>Način plaćanja:</b> 1. Odmah. 2. U celosti do polaska. 3. Uplata na rate čekovima. 4. Administrativna zabrana. 5. Kreditna kartia.
				<br>
				<b>Napomena:</b> Putnik se može opredeliti samo za jedan način plaćanja i ne može ga menjati.
				<br>
				Za slučaj spora nadležan je sud prema sedištu organizatora putovanja.
			</p>
			<p>
				<b>Ovim izjavljujem da sam upoznat sa programom i opštim Uslovima putovanja i osiguranja organizatora putovanja i da ih u potpunosti prihvatam, u svoje ime i u ime putnika iz ugovora.</b>
			</p>
		</td>
	</tr>
</table>
<table class="content textcenter valigncenter">
	<tr>
		<td class="">
			<br>	
			<br>	
			<br>	
			<hr>
			(Ime i prezime <br>korisnika usluga - ugovarača)
		</td>
		<td class="stamp">M.P.</td>
		<td class="">
			<br>
			<br>
			<hr>
			(Ovlašćeni subagent)
		</td>
	</tr>
</table>

</body>
</html>