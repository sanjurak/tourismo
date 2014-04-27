@extends('layout')

@section('content')

<div class="row" style="height:20px;"></div>
<div class="row">
	<div class="container">
		<div class="text-right span4 valign">
			<img src="images/clock_logo.png" />
		</div>
		<div class="span8 text-left">
	     {{ Form::open(array('url' => 'loginpost', 'id' => 'loginForm')) }}
		 <div class="control-group">
			  <label class="control-label" for="username">Username: </label>
			  <div class="controls">
			  	{{ Form::text('username') }}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password:</label>
			<div class="controls">{{ Form::password('password') }}</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="kurs">Kurs:</label>
			<div class="controls">{{ Form::text('exchangerate') }}</div>
		</div>
		<div class="control-group">
			 <div class="controls">{{ Form::submit('Login',['class' => 'btn btn-primary btn-medium openbutton']) }}</div>
		</div>
		 {{ Form::close() }}
		 </div>
	</div>
</div>
@stop