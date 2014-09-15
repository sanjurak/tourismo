@extends('home')
@section('content')
<!-- {{HTML::script('scripts/users.js')}} -->

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Izveštaji</a></li>
	    </ul>
	</nav>
</div>
</br>

<div class="container">

	<div class="tile-area">

	    <div class="tile-group nine" style="padding-top: 0px !important;">
	       
	       <a href="debts">
	        <div class="tile double live bg-amber" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/booking_reservation.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Dugovanja</span>
              </div>
	        </div>
	      </a>
	      <a href="dailyincome">
	        <div class="tile double live bg-gray" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/travelers.png"></div> -->
	          <!-- <div class="tile-content image"><img src="images/travelers2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Specifikacija dnevnog pazara</span>
              </div>
	        </div>
	      </a>
	      <a href="incomeforperiod">
	        <div class="tile double live bg-lightBlue" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/destinations.jpg"></div> -->
	          <!-- <div class="tile-content image"><img src="images/destinations2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Zarada za period</span>
              </div>
	        </div>
	      </a>

	      <a href="passangersforperiod">
	        <div class="tile double live bg-lightPink" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/booking_reservation.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Lista putnika za period</span>
              </div>
	        </div>
	      </a>
	      <a href="excursions">
	        <div class="tile double live bg-taupe" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/travelers.png"></div> -->
	          <!-- <div class="tile-content image"><img src="images/travelers2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Izveštaj o izletima</span>
              </div>
	        </div>
	      </a>
	      <a href="greenlist">
	        <div class="tile double live bg-darkGreen" data-role="live-tile" data-effect="slideUp">
	          <!-- <div class="tile-content image"><img src="images/destinations.jpg"></div> -->
	          <!-- <div class="tile-content image"><img src="images/destinations2.jpg"></div> -->
	          <div class="tile-status bg-dark opacity">
                 <span class="label" style="font-size: 12pt">Zelena lista</span>
              </div>
	        </div>
	      </a>
		</div>
	</div>
</div>

@include('notifications')

@stop