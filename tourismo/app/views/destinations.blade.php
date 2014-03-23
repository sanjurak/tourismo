@extends('home')
@section('content')

<div id="basicsearch" class="row">
	<div class='form-search'>
		
		<select name='search_item' id='basic' placeholder="Pretraživanje prema nazivu zemlje ili grada" class='form-control'></select>
		 <a class="btn btn-small" id="breset">Resetuj pretragu</a>
		 <a class="btn btn-small" id="advanced">Napredna pretraga</a>
	</div>
</div>
<div id="advancedSearch" class="row">
	<div>
		{{ Form::open(array('id' => 'advancedSearchForm', 'class' => 'form-inline form-search')) }}
		<label>Kategorija:</label> {{Form::select('categories',$categories,'0',array('class' => 'input-medium'))}} 
		<label>Zemlja:</label> {{Form::select('countries',$countries,'0',array('class' => 'input-medium'))}}
		<label>Grad:</label> {{Form::select('towns',$towns,'0',array('class' => 'input-medium'))}} 
		<label>Agencija:</label> {{Form::select('organizers',$organizers,'0',array('class' => 'input-medium'))}} 
		{{ Form::submit('Traži',['class' => 'btn btn-primary']) }}
		 {{ Form::close() }}
	 </div>
</div>

<a class="btn btn-primary btn-small" role="button" data-toggle="modal" href="#addDstModal" id="novaDst">Dodaj novu destinaciju</a>


<div id="list_view">
{{$destPartial}}
</div>

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
					      <input type="text" id="country" name="country" placeholder="Naziv zemlje">
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label" for="town">Grad:</label>
					    <div class="controls">
					      <input type="text" id="town" name="town" placeholder="Naziv grada">
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

@stop