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
			'username' => 'required|unique:users|max:100',
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
			'username' => $request->input('username'),
			'password' => bcrypt($request->input('password')),
			'birthdate' => $request->input('birthdate'),
			'agreed_terms' => $request->input('agreed_terms'),
		]);

		// Send mail to Matt as notification
		Mail::raw('New User', function ($message) {
		    $message->from('mjp1@yeayur.com', 'New User');
			$message->to('mjp1@yeayur.com')->subject('New User');
		});	

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
			
			Flash::overlay('Yeayur is a social network created exclusively to bring together streamers and viewers. Take the tour or jump right in. Remember, edit content by hovering your cursor over the item you want to edit.', 'Welcome to Yeayur!');

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
			return redirect()->route('forgotlogin');
		}

		return redirect()->route('discover.connections');
	}

	public function postRedirectSignin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6',
		]);	

		if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
			return redirect()->route('forgotlogin');
		}

		return redirect()->back();
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('index.public');
	}

	public function getForgotLogin()
	{
		return view('auth.forgotlogin');
	}
}

