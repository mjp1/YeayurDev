<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function getProfile ($username)
	{
		$user = User::where('username', $username)->first();

		$posts = Post::notReply()->where('profile_id', $user->id)->orderBy('created_at', 'desc')->get();

/*		$posts = Post::where(function($query) {
			return $query->where('profile_id', $user);
		})
		->orderBy('created_at', 'desc')->get();*/


		if (!$user) {
			abort(404);
		}

		return view('profile.index')
			->with([
				'user' => $user,
				'posts' => $posts
			]);
			
	}

	public function getEdit()
	{
		return view('profile.edit');
	}

	public function postEdit(Request $request)
	{

		$this->validate($request, [
			'email' => 'unique:users,email,'.Auth::user()->id.'|email|max:255',
			'password' => 'min:6',
			'confirm_password' => 'same:password', 
			'about_me' => 'max:500',
		]);

		if ($request->has('password'))
		{
			Auth::user()->update([
				'email' => $request->input('email'),
				'password' => bcrypt($request->input('password')),
				'confirm_password' => bcrypt($request->input('confirm_password')),
				'about_me' => $request->input('about_me'),
			]);
		}

			Auth::user()->update([
				'email' => $request->input('email'),
				'about_me' => $request->input('about_me'),
			]);

		

		return redirect()->route('profile.edit');
	}


	
}