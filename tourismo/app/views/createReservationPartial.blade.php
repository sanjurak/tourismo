<script type="text/javascript">
	$(function(){
		$("#traveldealDetails").hide();
		$("#traveldealNew").hide();
		$("#addCategoryModal").hide();
	
		$("#traveldealDetails input").prop("disabled", true);

	$("#traveldealsSelect").change(function(){
		var id = $(this).val();

		$.ajax({
			url: 'getTravelDeal/' + id,
			type:'GET',
			dataType:'json',
			success:function(data)
			{
				$("#category").val(data.data.category);
				$("#organizer").val(data.data.organizer);
				$("#destination").val(data.data.destination);
				$("#accomodation").val(data.data.accomodation);
				$("#transportation").val(data.data.transportation);
				$("#service").val(data.data.service);

				$("#traveldealDetails").slideDown();
			}
		});
	});

	$("#addTravelDeal").click(function(event){
		event.preventDefault();
		$("#traveldealDetails").slideUp();
		$("#traveldealNew").slideDown();

	});

	$("#btnAddTravelDeal").click(function(event){
		event.preventDefault();

		$.ajax({
			url:'',
			type: 'POST',
			data: $("#traveldealNewForm").serialize(),
			success: function(data){
					
			}
		})
	});

	$("#newCategory").click(function(){
		$("#addCategoryModal").modal("show");
	});

	$("#categorySel").selectize({
		valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'categoriesRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#destinationSel").selectize({
		valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'destinationsRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#organizerSel").selectize({
		valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'organizersRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});

	$("#accomodationSel").selectize({
		valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'accomodationsRes',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        }
	});
});
</script>
<div class="row">

	<div class="span12">Datum rezervacije: {{date("d/m/Y")}}</div>

	<div class="span12">
		<fieldset>
			<legend>Detalji aranžmana</legend>
			<div class="container">
				<div class="row">
					<div class="span12 pull-left">
						{{Form::select('traveldeals',$traveldeals,'0',array('class' => 'input-medium', 'id' => 'traveldealsSelect'))}} 
						<a href="#" class="btn btn-small btn-default pull-right" id="addTravelDeal">Dodaj novi aranžman</a>
					</div>
				</div>

				<div id="traveldealDetails" class="row">
					<div class="container">
						<div class="row">	
							<div class="span4"><label>Kategorija aranžmana:</label><input type="text" id="category"/></div>
							<div class="span4"><label>Organizator aranžmana:</label><input type="text" id="organizer"/></div>
							<div class="span4"><label>Destinacija:</label><input type="text" id="destination"/></div>
						</div>
						<div class="row">							
							<div class="span4"><label>Smeštaj:</label><input type="text" id="accomodation"/></div>
							<div class="span4"><label>Prevoz:</label><input type="text" id="transportation"/></div>
							<div class="span4"><label>Usluga:</label><input type="text" id="service"/></div>
						</div>
					</div>
				</div>

				<div id="traveldealNew" class="row">
					<div class="container">
						<form id="traveldealNewForm" name="traveldealNewForm">
							<div class="row">	
								<div class="span4">
									<label>Kategorija aranžmana:</label>
									<select name='category' id='categorySel' placeholder="Kategorija" class='form-control'></select>
								</div>
								<div class="span4">
										<label>Organizator aranžmana:</label>
										<select name='organiyer' id='organizerSel' placeholder="Organizator" class='form-control'></select>
									</div>
								<div class="span4">
										<label>Destinacija:</label>
										<select name='destination' id='destinationSel' placeholder="Destinacija" class='form-control'></select>
									</div>
							</div>
							<div class="row">							
								<div class="span4">
										<label>Smeštaj:</label>
										<select name='accomodation' id='accomodationSel' placeholder="Smeštaj" class='form-control'></select>
									</div>
								<div class="span4">
										<label>Prevoz:</label>
										<input type="text" name="transportation" id="transportation"/>
									</div>
								<div class="span4">
										<label>Usluga:</label>
										<input type="text" name="service" id="service"/>
								</div>
							</div>
							<div class="row">
								<div class="span12">
									<button class="btn btn-primary" id="btnAddTravelDeal">Dodaj</button>
								</div>
							</div>
						</form>
					</div>
				</div>
		</div>
		</fieldset>
	</div>
</div>

<div class="row">
	<div class="span7">
		<div id="addCategoryModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Nova kategorija</h3>
			</div>

			<div class="modal-body">
				<form id="addNewCategoryForm" name="newCategoryForm" class="form-horizontal">
				  <div class="control-group">
				    <label class="control-label" for="country">Naziv:</label>
				    <div class="controls">
				      <input type="text" id="name" name="name" placeholder="Naziv kategorije" class="validate[required]" />
				    </div>
				  </div>
				</form>
			</div>
			<div class="modal-footer">  
				<a id="addNewCategory" class="btn btn-success">Sačuvaj</a>  
				<a  class="btn" data-dismiss="modal">Odustani</a>  
					
			</div> 
		</div>
	</div>
</div>
