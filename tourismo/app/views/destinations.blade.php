@extends('home')
@section('content')

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Destinacije</a></li>
	    </ul>
	</nav>
</div>
</br>

	<div id="basicsearch" class="row">
		<div class="container">
			<div class='form-search'>
				<select name='search_item' id='basic' placeholder="Pretraživanje prema nazivu zemlje ili grada" class='form-control'></select>
			</div>
			<div class="">
				 <a role="button" class="btn btn-default btn-small" id="breset">Resetuj pretragu</a>
				 <a role="button" class="btn btn-small" id="advanced">Napredna pretraga</a>
			</div>
		</div>
	</div>
	<div id="advancedSearch" class="row">
		<div class="container">
			<fieldset>
				<legend>Napredna pretraga destinacija</legend>
				{{ Form::open(array('id' => 'advancedSearchForm', 'class' => 'form-inline form-search')) }}
				<div class="row">
					<div class="span3"><label>Kategorija:</label> {{Form::select('categories',$categories,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Zemlja:</label> {{Form::select('countries',$countries,'0',array('class' => 'input-medium'))}}</div>
					<div class="span3"><label>Grad:</label> {{Form::select('towns',$towns,'0',array('class' => 'input-medium'))}} </div>
					<div class="span3"><label>Agencija:</label> {{Form::select('organizers',$organizers,'0',array('class' => 'input-medium'))}} </div>
				</div>
				<div class="row">
					<div class="span4 pull-left">{{ Form::submit('Traži',['class' => 'btn btn-primary']) }}</div>
				</div>
				 {{ Form::close() }}
			 </fieldset>
		 </div>
	</div>


<div class="row">
	<div class="container">
		<a class="btn btn-primary btn-small pull-right" role="button" data-toggle="modal" href="#addDstModal" id="novaDst">Dodaj novu destinaciju</a>
	</div>
</div>

<div class="row">
	<div id="list_view" class="container">
	{{$destPartial}}
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="addDstModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Nova destinacija</h3>
			</div>

			<div class="modal-body">
				<form id="addNewDstForm" name="newDestinationForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="country">Zemlja:</label>
				    <div class="controls">
				      <input type="text" id="country" name="country" placeholder="Naziv zemlje" class="validate[required]" />
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="town">Grad:</label>
				    <div class="controls">
				      <input type="text" id="town" name="town" class="validate[required]" placeholder="Naziv grada">
				    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="description">Opis destinacije</label>
				    <div class="controls">
				      <textarea id="description" name="description" placeholder="Opis destinacije"></textarea>
				    </div>
				  </div>
				</form>

			</div>

			<div class="modal-footer">  
				<a id="addNewDst" class="btn btn-success">Sačuvaj</a>  
				<a  class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>

@stop