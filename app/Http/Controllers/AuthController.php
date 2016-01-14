<?php

namespace Yeayurdev\Http\Controllers;

use Flash;
use Auth;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup');
	}

	public function postSignup(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password',
			'username' => 'required|unique:users|max:255',
			'birthdate' => 'required|date|before:13 years ago',
			'agreed_terms' => 'required|accepted',
		]);


		User::create([
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password')),
			'confirm_password' => bcrypt($request->input('confirm_password')),
			'username' => $request->input('username'),
			'birthdate' => $request->input('birthdate'),
			'agreed_terms' => $request->input('agreed_terms'),
		]);


		if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
					Flash::overlay('Go ahead and look around. You can personalize your profile by going to the Edit Profile page', 'Welcome to Yeayur!');

			return redirect()->route('profile', ['username' => Auth::user()->username]);
		}
}

	public function postSignin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6',
		]);	

		if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
			return redirect()->back();
		}

		return redirect()->route('profile', ['username' => Auth::user()->username]);
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home');
	}


}

