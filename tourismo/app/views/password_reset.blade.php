@extends('layout')

@section('content')

<div class="row" style="height:20px;"></div>
<div class="row">
	<div class="container">
		<div class="text-right span4 valign">
			<img src="http://manage.clocktravel.rs/images/clock_logo.png" />
		</div>
		<div class="span8 text-left">
			{{ Form::open(array('url' => 'password/doreset', 'method' => 'POST')) }}
			    <input type="hidden" name="token" value="{{ $token }}">
			    <label for='email'>Email</label>
			    <input type="email" name="email">
			    <label for='password'>Nova šifra</label>
			    <input type="password" name="password">
			    <label for='password'>Potvrdi novu šifru</label>
			    <input type="password" name="password_confirmation">
			    <br>
			    <input type="submit" value="Reset Password">
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop