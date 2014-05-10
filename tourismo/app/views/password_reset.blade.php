@extends('layout')

@section('content')

<div class="row" style="height:20px;"></div>
<div class="row">
	<div class="container">
		<div class="text-right span4 valign">
			<img src="images/clock_logo.png" />
		</div>
		<div class="span8 text-left">
			<form action="{{ action('RemindersController@postReset') }}" method="POST">
			    <input type="hidden" name="token" value="{{ $token }}">
			    <input type="email" name="email">
			    <input type="password" name="password">
			    <input type="password" name="password_confirmation">
			    <input type="submit" value="Reset Password">
			</form>
		</div>
	</div>
</div>
@stop