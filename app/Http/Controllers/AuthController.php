<?php

namespace Yeayurdev\Http\Controllers;

use Flash;
use Auth;
use Mail;
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

		/**
		 *   Validate registration inputs
		 */

		$this->validate($request, [
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password',
			'birthdate' => 'required|date|before:13 years ago',
			'agreed_terms' => 'required|accepted',
		]);

		/**
		 *   Create new user
		 */

		$user = User::create([
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password')),
			'birthdate' => $request->input('birthdate'),
			'agreed_terms' => $request->input('agreed_terms'),
		]);

		/**
		 *   Send welcome email to user
		 */

		/*Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
			$m->from('register@yeayur.com', 'Yeayur');
			$m->to($user->email);
			$m->subject('Welcome To Yeayur');
		});*/

		/**
		 *   Authenticate new user and redirect to new profile page
		 */

		if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
			return redirect()->route('oauth.oauth')->with('user' , Auth::user()->id);
		}
	}

	public function postSignin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6',
		]);	

		if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
			return redirect()->route('forgotlogin');
		}

		if (!Auth::user()->username)
		{
			return redirect()->route('oauth.oauth')->with('user' , Auth::user()->id);
		}

		return redirect()->route('profile', ['username' => Auth::user()->username]);
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home');
	}

	public function getForgotLogin()
	{
		return view('auth.forgotlogin');
	}
}

