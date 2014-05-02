<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		 $users = User::paginate(10);

    	 return View::make('users')->with('users', $users)->nest('usersPartial','usersPartial', array('users' => $users));
	}

	public function login()
	{
		 $userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
		 );

		 Session::put('exchRate', Input::get('exchRate'));

		 if (Auth::attempt($userdata))
		 {
    	    // The user is being remembered...
    	    Session::put('username', $userdata['username']);
    	    Session::put('role', User::find($userdata['username'])->role_id);
		    return Redirect::intended('homepage');
		 }
		 else {
		 	return Redirect::back();
		 }
		 
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::intended('/');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->role_id = Input::get('role_id');
		$user->name = Input::get('name');
		$user->surname = Input::get('surname');
		$user->email = Input::get('email');

		$user->save();

		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if ($user->role_id == 1) {
			if(User::where('role_id','=','1')->count() < 2) {
				Session::flash('error', 'At least one Administrator is needed');
				return Redirect::back();
			}
			else {
				User::destroy($id);
				Session::flash('success', 'User "'.$id.'" deleted');
				return Redirect::back();
			}
		} else {
			User::destroy($id);
			Session::flash('success', 'User "'.$id.'" deleted');
			return Redirect::back();
		}
	}


}