@extends('home')
@section('content')
<!-- {{HTML::script('scripts/users.js')}} -->

<div class="container">
	<nav class="breadcrumbs large">
	    <ul class="pull-left">
	        <li><a href="homepage">Home</a></li>
	        <li class="active"><a href="#">Korisnici</a></li>
	    </ul>
	</nav>
</div>
</br>

@include('notifications')

<div class="row">
	<div class="pull-right">
		<a role="button" class="usersNew btn btn-default btn-small" id="addNewUser" data-toggle="modal" href="#usersNewModal">Dodaj novog korisnika</a>
	</div>
</div>

{{ $users->links() }}

<p/>
<div  id="usersData">
	{{ $usersPartial }}
</div>

<div class="container">
	<div class="row">
		<div id="usersNewModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Novi korisnik</h3>
			</div>
			{{ Form::open(array('url' => 'storeUser', 'name' => 'addNewUserForm', 'id' => 'addNewUserForm' )) }}
			<div class="modal-body">
			</br>
				<table class="table">
					<tr>
						<td>
							<div class="input-control text">
								<input type="text" class="validate[required]" name="username" id="username" placeholder="Korisničko ime">
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="password" class="validate[required]" name="password" id="password" placeholder="Šifra"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<select class="validate[required]" name="role_id" id="role_id">
									<option value="" disabled selected="selected" style='display:none;'>Uloga</option>
									<option value="0">user</option>
									<option value="1">administrator</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-control text">
								<input type="text" id="name" class="validate[required]" name="name" placeholder="Ime"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" class="validate[required]" name="surname" id="surname" placeholder="Prezime"/>
							</div>
						</td>
						<td>
							<div class="input-control text">
								<input type="text" class="validate[required]" name="email" id="email" placeholder="E-mail"/>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="modal-footer">  
				<button type="submit" id="addNewUser" class="btn btn-success">Sačuvaj</button>
				<a class="btn btn-cancel" data-dismiss="modal">Odustani</a>  	
			</div> 
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop