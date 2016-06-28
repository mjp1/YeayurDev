<?php

namespace Yeayurdev\Http\Controllers;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Flash;
use Auth;
use Mail;
use Session;
use DB;
use Carbon\Carbon;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller 
{
	public function getSignup()
	{
		return view('auth.signup');
	}

	public function registerWithTwitch(Request $request)
	{
		/**
		 *   Create new user
		 */

		$user = Session::get('newUser');
		$user = $user[0];

		$user = User::create([
            'email' => $user['email'],
            'username' => $user['username'],
            'twitch_username' => $user['twitch_username'],
            'image_path' => $user['image_path'],
            'about_me' => $user['about_me']
        ]);

        Auth::login($user, true);
        
        // Store Twitch Oauth token

		$userToken = Session::get('userToken');
		$userToken = $userToken[0];

        DB::table('oauth_tokens')->insert([
            'user_id' => Auth::user()->id,
            'Twitch' => $userToken['Twitch'],
            'Twitch_refresh' => $userToken['Twitch_refresh'],
            'created_at' => Carbon::now()
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
		 *  Add to Algolia Index
		 */

		$newUser = $user;
		$newUser->pushToIndex('Yeayur_Users');

		Flash::overlay('Yeayur is a network all about helping each other become better at doing what we love, streaming. So, update your profile, look around, and help your fellow streamers by providing feedback on their profile page.', 'Welcome to Yeayur!');

		return redirect()->route('profile', ['username' => Auth::user()->username]);
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

