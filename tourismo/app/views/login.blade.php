@extends('layout')

@section('content')
     {{ Form::open(array('url' => 'login')) }}
	  Username: <br/>
	  {{ Form::text('username') }} <br/>
	  Password: <br/>
	  {{ Form::password('password') }} <br/><br/>
	  {{ Form::submit('Submit') }}
	 {{ Form::close() }}
@stop