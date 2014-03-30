<script type="text/javascript">
$(function(){

	$(".editableC").editable();
});
</script>
<table class="table table-hover">
		<tr>
			<th>PIB</th>
			<th>Matični broj</th>
			<th>Naziv</th>
			<th>Email</th>
			<th>Adresa</th>
			<th>Telefon</th>
			<th>Web sajt</th>
			<th></th>
		</tr>
@foreach($organizators as $organizator)
	<tr id={{$organizator->pib}}>
		<td>
			<a href="#" class="editableC" id="pib" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="PIB organizatora">{{$organizator->pib}}</a>
		</td>
			
		<td>
			<a href="#" class="editableC" id="mat_br" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Matični broj">{{$organizator->mat_br}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="name" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Ime organizatora">{{$organizator->name}}</a>
		</td>
		<td>			
			<a href="#" class="editableC" id="email" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Email organizatora">{{$organizator->email}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="address" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Adresa organizatora">{{$organizator->address}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="phone" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Telefon organizatora">{{$organizator->phone}}</a>
		</td>
		<td>
			<a href="#" class="editableC" id="web" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Web sajt organizatora">{{$organizator->web}}</a>
		</td>
		<td>
			<a href="#" data-id={{$organizator->pib}} class="btn btn-warning editOrg"><span class="icon-edit"></span></a>	
			<a href="#" class="btn btn-danger deleteOrg" data-id={{$organizator->pib}}><span class="icon-trash"></span></a>	
		</td>
	</tr>
@endforeach
</table>