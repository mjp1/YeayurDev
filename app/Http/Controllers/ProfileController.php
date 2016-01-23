<?php

namespace Yeayurdev\Http\Controllers;

use DB;
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

		$profileVisits = DB::table('recently_visited')->where('visitor_id',Auth::user()->id)->orderBy('times_visited', 'desc')->get();

		/**
		 *  Code for recently_visited table. If user has not previously
		 *  visited that profile, create a record. If user has, then  
		 *  increment the "times_visited" column.
		 */

		if (!Auth::user()->previouslyVisited($user)) {

			Auth::user()->addProfileVisits($user);
        }
			
		$visits = DB::table('recently_visited')
			->where('profile_id',$user->id)
			->where('visitor_id',Auth::user()->id)
			->increment('times_visited');
			/*->update(['times_visited' => DB::raw('times_visited + 1')]);*/
		
		if (!$user) {
			abort(404);
		}

		return view('profile.index')
			->with([
				'user' => $user,
				'posts' => $posts,
				'profileVisits' => $profileVisits,
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