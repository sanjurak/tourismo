<table class="table striped">
	<thead style="font-weight:bold">
		<tr>
			<td>Ime</td>
			<td>Prezime</td>
			<td>Username</td>
			<td>E-mail</td>
			<td>Uloga</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	@foreach ($users as $user)
	<tr>
		<td>
			{{ $user->name }}
		</td>
		<td>
			{{ $user->surname }}
		</td>
		<td>
			{{ $user->username }}
		</td>
		<td>
			{{ $user->email }}</td>
		<td>
			@if ($user->role_id == 0)
				user
			@elseif ($user->role_id == 1)
				administrator
			@endif
		</td>
		<td>
			<a href="deleteUser/{{$user->username}}" class="btn btn-danger pull-right">
			<span class="icon-trash"></span>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>