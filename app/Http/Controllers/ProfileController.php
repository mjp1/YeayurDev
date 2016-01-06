<?php

namespace Yeayurdev\Http\Controllers;

use Image;
use Input;
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
			'profile-image' => 'image|max:4999',
			'about_me' => 'max:500',
		]);

		Auth::user()->update([
			'email' => $request->input('email'),
			'about_me' => $request->input('about_me')
		]);

		if (Input::hasFile('profile-image'))
		{
			$extension = Input::file('profile-image')->getClientOriginalExtension();
			$fileName = rand(11111,99999).'.'.$extension;
			
			$image = Image::make(Input::file('profile-image'))->orientate()->save('images/profiles/'.$fileName);
			
			Auth::user()->update([
				'image_path' => $fileName,
			]);
		}

		if ($request->has('password'))
		{
			Auth::user()->update([
				'password' => bcrypt($request->input('password')),
				'confirm_password' => bcrypt($request->input('confirm_password')),
			]);
		}

		return redirect()->route('profile.edit')->with('info', 'You have updated your profile!');
	}
}