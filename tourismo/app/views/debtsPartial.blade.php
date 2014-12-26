<script type="text/javascript">
$(function(){
	$(".res-debt-row").hide();
	var list = $(".debt-row");
	for (i = 0, len = list.length; i < len; i++){
		var clickHandler = 
            function(row) 
            {
                return function() { 
	            	var hiddenRow = document.getElementById(row.getAttribute("name"));
	            	if (hiddenRow.style.display == "none")
	                	$(hiddenRow).show( "slow" );
	                else
	                	$(hiddenRow).hide( "slow" );
	            };
            };

        list[i].onclick = clickHandler(list[i]);
    }
});
</script>

<table class="table striped">
	<thead style="font-weight:bold">
		@if ($total_dept_din = 0) @endif
		@if ($total_dept_eur = 0) @endif
		@foreach ($debts as $debt)
			@if ($total_dept_din = $total_dept_din + $debt->debt_din) @endif
			@if ($total_dept_eur = $total_dept_eur + $debt->debt_eur) @endif
		@endforeach
		<tr>
			<th colspan='4'>TOTAL</th>
			<th>{{ number_format($total_dept_eur, 2) }} EUR</th>
			<th>{{ number_format($total_dept_din, 2) }} DIN<th>
		</tr>
		<tr>
			<td>Ime i Prezime</td>
			<td>Adresa</td>
			<td>Mobilni</td>
			<td>JMBG</td>
			<td>Dugovanje EUR</td>
			<td>Dugovanje DIN</td>
		</tr>
	</thead>
	<tbody>
	@foreach ($debts as $debt)
	<tr class='debt-row' name='{{ $debt->passanger_id }}' OnMouseOver="this.style.cursor='pointer';" OnMouseOut="this.style.cursor='default';">
		<td>
			{{ $debt->passanger_name }}</td>
		<td>
			{{ $debt->passanger_address }}</td>
		<td>
			{{ $debt->passanger_tel }}</td>
		<td>
			{{ $debt->passanger_jmbg }}</td>
		<td>
			{{ number_format($debt->debt_eur, 2) }}</td>
		<td>
			{{ number_format($debt->debt_din, 2) }}</td>
	</tr>
	<tr class='res-debt-row' id='{{ $debt->passanger_id }}'>
		<td></td>
		<td colspan="5" style="padding:0; margin:0;">
			<table style="width:100%;padding:0; margin:0;">
				<tr>
					<th></th>
					<th>Rezervacija</th>
					<th>Početak</th>
					<th>Destinacija</th>
					<th>Dugovanje EUR</th>
					<th>Dugovanje DIN</th>
				</tr>
				@foreach ($debt->reservations as $resPsg)
				<tr>
					<td></td>
					<td>{{ $resPsg->reservation_number }}</td>
					<td>{{ $resPsg->res_start_date }}</td>
					<td>{{ $resPsg->destination }}</td>
					<td>{{ number_format($resPsg->left_to_pay_eur, 2) }}</td>
					<td>{{ number_format($resPsg->left_to_pay_din, 2) }}</td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>