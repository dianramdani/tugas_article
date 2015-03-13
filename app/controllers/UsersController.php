<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
        
        public function reset_password() {
            return View::make('users.reset_password');
        }
        
        public function process_reset_password() {
            $valid = array('email' => 'required|email');
            $data = Input::all();
            $validate = Validator::make($data, $valid);
            $find_data = User::where('email', Input::get('email'))->first();
            
            if($validate->fails()) {
                return Redirect::to('reset-password')
                ->withErrors($validate)
                ->withInput();
            } elseif(empty($find_data)) {
                Session::flash('error', 'Email not found'.Input::get('email'));
                return Redirect::to('reset-password')
                ->withErrors($validate)
                ->withInput();
            } else {
                $find_data->remember_token = str_random(60);
                $find_data->save();
              
                Mail::send('emails.instructionresetpassword', $find_data->toArray(''),
                function($message) use($find_data) {
                    $message->to($find_data->email, $find_data->username)->subject('Reset Password Instruction to Jambal Laravel');
                });
                Session::flash('notice', 'Check your email, the reset password instruction has sent to '.$find_data->email);
                return Redirect::to('/');
            }
        }
        
        public function change_password($remember_token)
        {
            $find_user = User::where('remember_token', $remember_token)->first();
            if(empty($find_user)) {
                Session::flash('error', 'Token not valid, :)');
                return Redirect::to('/');
            } else {
                return View::make('users.change_password')
                ->with( 'remember_token', $find_user->remember_token);
            }
        }

        public function process_change_password($remember_token)
        {
            $valid = array('password' => ('required|min: 8|confirmed'));
            $data = Input::all();
            $find_data = User::where('remember_token', $remember_token)->first();
            $validate = Validator::make($data, $valid);
            if($validate->fails()) {
                return Redirect::to('change-password/'.$find_data->remember_token)
                ->withErrors($validate);
            } else {
                $find_data->remember_token = null;
                $find_data->password = Hash::make(Input::get('password'));
                $find_data->save();
                Session::flash('notice', 'Hai '.$find_data->username.' Password has change lets login');
                return Redirect::to('sessions/create');
            }
        }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $data = Input::all();
            $validate = Validator::make($data, User::valid());
            if($validate->fails()) {
                return Redirect::to('users/create')->withErrors($validate)->withInput();
            } else {
                $user = new User;
                $user->email = Input::get('email');
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->save();
                Session::flash('notice', 'Signup Success');
                return Redirect::to('home');
            }
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
		//
	}


}
