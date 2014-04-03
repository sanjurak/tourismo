
<script type="text/javascript">
$(function(){

	$("#newAccModal").hide();
});
</script>

<div id="newAccModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
	<div class="modal-header">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Dodavanje novog smeštaja</h3>
	</div>

	<div class="modal-body">
		<form id="newAccForm" name="newAccForm" class="form-horizontal">
		  <div class="control-group">
		    <label class="control-label" for="type">Tip smeštaja:</label>
		    <div class="controls">
		    	<select name='type' id='typeModNew' placeholder="Tip smeštaja" class='form-control'></select>
		      <input type="text" id="typeModNew" name="type" placeholder="Tip" class="validate[required]" />
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="name">Naziv:</label>
		    <div class="controls">
		      <input type="text" id="nameModNew" name="name" class="validate[required]" placeholder="Naziv">
		    </div>
		  </div>
		   <div class="control-group">
		    <label class="control-label" for="name">Destinacija</label>
		    <div class="controls">
		      {{Form::select('destination_id',$destinations,'0',array('class' => 'input-medium'))}} 
		    </div>
		  </div>
		</form>

	</div>

	<div class="modal-footer">  
		<a id="newAccBtn" class="btn btn-success">Sačuvaj</a>  
		<a  id="closeNewAccModal" class="btn" data-dismiss="modal">Odustani</a>  
			
	</div> 
</div>