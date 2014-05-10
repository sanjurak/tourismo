@extends('layout')

@section('content')

<div class="row" style="height:20px;"></div>
<div class="row">
	<div class="container">
		<div class="text-right span4 valign">
			<img src="images/clock_logo.png" />
		</div>
		<div class="span8 text-left">
			{{ Form::open(array('url' => 'doPswReset', 'id' => 'resetForm')) }}
			 <div class="control-group">
				  <label class="control-label" for="email">E-mail: </label>
				  <div class="controls">
				  	{{ Form::text('email') }}
				</div>
			</div>
			<div class="control-group">
				 <div class="controls">{{ Form::submit('Reset',['class' => 'btn btn-primary btn-medium openbutton']) }}</div>
			</div>
		 {{ Form::close() }}
		</div>
	</div>
</div>
@stop