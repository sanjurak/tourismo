@extends('layout')
@section('content')
<?php
	$passangers = Passanger::all();
	foreach ($passangers as $passanger)
	{
    	echo "<p>This is passanger ";
    	echo $passanger->name;
    	echo " ";
    	echo $passanger->surname;
    	echo "</p>";
	}
?>
@stop