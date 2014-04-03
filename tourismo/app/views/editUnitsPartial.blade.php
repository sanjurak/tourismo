

		<form id="editUnitsForm" name="ediUnitsForm" class="form-horizontal">
		  
		  	{{-- */$i=0;/* --}}
		  	@foreach($units as $unit)
		  	<input type="hidden" id="idModEdit" name="Units[{{$i}}][id]" value={{$unit->id}}>
			  <div class="control-group">  
			    <label class="control-label" for="type">Tip smeštaja:</label>			    
			    <div class="controls">
			    	<input type="text" id="typeModEdit" name="Units[{{$i}}][name]" class="form-control validate[required]" placeholder="Tip smeštaja" value={{$unit->name}}>
			    </div>
			  </div>

			  <div class="control-group">
			    <label class="control-label" for="name">Naziv:</label>
			    <div class="controls">
			      <input type="text" id="nameModEdit" name="Units[{{$i}}][capacity]" class="form-control validate[required]" placeholder="Kapacitet" value={{$unit->capacity}}>
			    </div>
			  </div>

			   <div class="control-group">
			    <label class="control-label" for="name">Broj</label>
			    <div class="controls">
			       <input type="text" id="numberModEdit" name="Units[{{$i}}][number]" class="form-control validate[required]" placeholder="Broj" value={{$unit->number}}>
			    </div>
			  </div>
			  {{-- */$i++;/* --}}
		  @endforeach
		</form>
	

	