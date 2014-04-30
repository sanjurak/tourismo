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

	    <div class="tile-group nine" style="padding-top: 0px !important;">
			<!-- <div style="background-image: url(images/clock_travel_baner.jpg);background-position: 90px -120px;background-repeat: no-repeat;margin-bottom:10px;width: 750px;height: 200px;"></div> -->

	       <a href="reservations">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	         <!-- <div class="tile-content image"><img src="images/reservations.jpg"></div> -->
	          <div class="tile-content image"><img src="images/booking_reservation.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Rezervacije</span>
              </div>
	        </div>
	      </a>
	      <a href="passangers">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content image"><img src="images/travelers.png"></div>
	          <!-- <div class="tile-content image"><img src="images/travelers2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Putnici</span>
              </div>
	        </div>
	      </a>
	      <a href="destinations">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content image"><img src="images/destinations.jpg"></div>
	          <!-- <div class="tile-content image"><img src="images/destinations2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Destinacije</span>
              </div>
	        </div>
	      </a>
	      <a href="traveldeals">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/arrangement.jpg"></div> -->
	          <div class="tile-content image"><img src="images/arrangement2.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Aranžmani</span>
              </div>
	        </div>
	      </a>
	      <a href="payments">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/credit-card.jpg"></div> -->
	          <div class="tile-content image"><img src="images/pay.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Plaćanja</span>
              </div>
	        </div>
	      </a>
	      <a href="reports">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/report.jpg"></div> -->
	          <div class="tile-content image"><img src="images/report2.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Izveštaji</span>
              </div>
	        </div>
	      </a>
	      <a href="accommodation">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/accomodation.jpg"></div> -->
	          <div class="tile-content image"><img src="images/accommodation-key.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Smeštaj</span>
              </div>
	        </div>
	      </a>
	      <a href="organizators">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/partners.jpg"></div> -->
	          <div class="tile-content image"><img src="images/partners2.jpg"></div>
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Organizatori</span>
              </div>
	        </div>
	      </a>
	      <a href="users">
	        <div class="tile double live bg-darkGray" data-role="live-tile" data-effect="slideUp">
	          <div class="tile-content image"><img src="images/users.jpg"></div>
	          <!-- <div class="tile-content image"><img src="images/users2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Korisnici</span>
              </div>
	        </div>
	      </a>
		</div>
	</div>
</div>


@stop