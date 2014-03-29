@extends('home')
@section('content')

<div class="container">
	<!-- <div class='row'>
		<div id='rezervacije' class="span4, tile double">
			{{HTML::linkRoute('reservations', 'Rezervacije')}}
		</div>
		<div id='putnici' class="span4, tile double">
			{{HTML::linkRoute('passangers', 'Putnici')}}
		</div>
		<div id='destinacije' class="span4, tile double">
			{{HTML::linkRoute('destinations', 'Destinacije')}}
		</div>
	</div>
	<div class="row">
		<div id='aranzmani' class="span4, tile double">Aranžmani</div>
		<div id='placanja' class="span4, tile double">Plaćanja</div>
		<div id='izvestaji' class="span4, tile double">Izveštaji</div>
	</div>
	<div class="row">
		<div id='korisnici' class="span4, tile double">Korisnici</div>
	</div> -->
	<div class="tile-area">
	    <div class="tile-group nine">
	       <a href="reservations">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Rezervacije</p></center></div>
	          <div class="tile-content"><center><p>Reservations</p></center></div>
	        </div>
	      </a>
	      <a href="passangers">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Putnici</p></center></div>
	          <div class="tile-content"><center><p>Passangers</p></center></div>
	        </div>
	      </a>
	      <a href="destinations">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Destinacije</p></center></div>
	          <div class="tile-content"><center><p>Destinations</p></center></div>
	        </div>
	      </a>
	      <a href="arangements">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Aranžmani</p></center></div>
	          <div class="tile-content"><center><p>Arangements</p></center></div>
	        </div>
	      </a>
	      <a href="payments">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Plaćanja</p></center></div>
	          <div class="tile-content"><center><p>Payments</p></center></div>
	        </div>
	      </a>
	      <a href="reports">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Izveštaji</p></center></div>
	          <div class="tile-content"><center><p>Reports</p></center></div>
	        </div>
	      </a>
	      <a href="accommodation">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content"><center><p>Smeštaj</p></center></div>
	          <div class="tile-content"><center><p>Accommodation</p></center></div>
	        </div>
	      </a>
		</div>
	</div>
</div>


@stop