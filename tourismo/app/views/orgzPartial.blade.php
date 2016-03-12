<script type="text/javascript">
$(function(){
	
	
	$(".deleteOrg").click(function(event){
		event.preventDefault();

		//id objekaa za brisanje (id je pib)
		var id = $(this).attr("data-id");
		$("#pibDel").val(id);
		$("#deleteOrgModal").modal("show");		

	});

	$(".editableC").editable();
	
	
	$(".editOrg").click(function(event){

		event.preventDefault();

		//id reda u tabeli kome pripada objekat za editovanje (id je pib)
		var id = $(this).attr("data-id");

		//na osnovu pib-a pribavljaju se trenutne vrednosti atributa organizatora
		var pib = $("#" + id).find("#pib").text();
		var matbr = $("#" + id).find("#mat_br").text();
		var name = $("#" + id).find("#name").text();
		var address = $("#" + id).find("#address").text();
		var phone = $("#" + id).find("#phone").text();
		var web = $("#" + id).find("#web").text();
		var email = $("#" + id).find("#email").text();
		var provision = $("#" + id).find("#provision").text().trim();
		var licence = $("#" + id).find("#licence").text().trim();
		var licencetext = $("#" + id).find("#licence_text").text().trim();
		var bankaccount = $("#" + id).find("#bankaccount").text().trim();
		
		//upisivanje trenutnih vrednosti u modal dialog formu
		$("#pibMod").val(pib);
		$("#mat_brMod").val(matbr);
		$("#nameMod").val(name);
		$("#addressMod").val(address);
		$("#phoneMod").val(phone);
		$("#webMod").val(web);
		$("#emailMod").val(email);
		$("#provisionMod").val(provision);
		$("#licenceMod").val(licence);
		$("#licenceTextMod").val(licencetext);
		$("#bankaccountMod").val(bankaccount);

		//otvaranje edit forme u modal dialogu
		$("#editOrgModal").modal("show");
	});

});
</script>

{{ $organizators->links() }}

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
			<a href="#" class="btn btn-warning editOrg" data-id={{$organizator->pib}}><span class="icon-edit"></span></a>	
			<a href="#" class="btn btn-danger deleteOrg" data-id={{$organizator->pib}}><span class="icon-trash"></span></a>	
			<a href="#" style="display:none;" id="provision" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Provizija">
				@if(!is_null($organizator->provision))
					{{trim($organizator->provision)}}
				@endif	
			</a>
			<a href="#" style="display:none;" id="licence" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Broj licence">
				@if(!is_null($organizator->licence))
					{{trim($organizator->licence)}}
				@endif
			</a>
			<a href="#" style="display:none;" id="licence_text" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Text licence">
				@if(!is_null($organizator->licence_text))
					{{trim($organizator->licence_text)}}
				@endif
			</a>
			<a href="#" style="display:none;" id="bankaccount" data-type="text" data-pk= {{$organizator->pib}} data-url="/organizatorEdit/{{$organizator->pib}}" data-title="Broj računa">
				@if(!is_null($organizator->bankAccount))
					{{trim($organizator->bankAccount)}}
				@endif
			</a>
		</td>
	</tr>
@endforeach
</table>