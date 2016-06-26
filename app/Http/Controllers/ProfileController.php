<?php

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Events\UserNotificationStream;

use Carbon\Carbon;
use DB;
use Image;
use Input;
use Auth;
use Storage;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

class ProfileController extends Controller
{
	public function getProfile ($username)
	{

		$user = User::where('username', $username)->first();

		$posts = Post::notReply()->where('profile_id', $user->id)->orderBy('created_at', 'desc')->get();

		/**
		 *  Code for recently_visited table. If user has not previously
		 *  visited that profile, create a record. If user has, then  
		 *  increment the "times_visited" column.
		 */
		if (Auth::check())
		{
			if (!Auth::user()->previouslyVisited($user) && Auth::user()->id !== $user->id) {

				Auth::user()->addProfileVisits($user);
	        }
				
			$visits = DB::table('recently_visited')
				->where('profile_id',$user->id)
				->where('visitor_id',Auth::user()->id)
				->increment('times_visited', 1, ['last_visit' => Carbon::now()]);
		}	

		if (!$user) {
			abort(404);
		}

		// Return most recent 5 videos by Twitch user

		$videos = json_decode(file_get_contents('https://api.twitch.tv/kraken/channels/'.$user->username.'/videos?limit=5'), true);
        $videos = $videos['videos'];
 	

		return view('profile.index')
			->with([
				'user' => $user,
				'posts' => $posts,
				'videos' => $videos,
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
		]);

		Auth::user()->update([
			'email' => $request->input('email'),
		]);

		if ($request->has('password'))
		{
			Auth::user()->update([
				'password' => bcrypt($request->input('password')),
			]);
		}

		return redirect()->route('profile.edit')->with('info', 'You have updated your profile!');
	}

	public function postEditPic(Request $request)
	{
		if ($request->ajax())
		{
			if (Input::file('file'))
			{
				$this->validate($request, [
					'file' => 'required|image|max:4999'
				],[
					'required' => 'You must select an image before submitting.',
					'max' => 'The file size cannot exceed 5MB.'
				]);

				$extension = Input::file('file')->getClientOriginalExtension();
				$fileName = rand(11111,999999999).'.'.$extension;
				
				$image = Image::make($request->file('file'))
					->orientate()
					->fit(100, 100, function ($constraint) { 
						$constraint->aspectRatio();
					});

				$image = $image->stream();

				Auth::user()->update([
					'image_path' => $fileName,
				]);

				$s3 = \Storage::disk('s3');
				$filePath = '/images/profile/'.$fileName;

				$s3->put($filePath, $image->__toString(), 'public'); 
			}
		}
			
	}

	public function postEditAbout(Request $request)
	{
		$this->validate($request, [
			'streamer-about-me-input' => 'required',
		], [
			'required' => 'You must enter in some information before submitting.',
		]);

		Auth::user()->update([
			'about_me' => $request->input('streamer-about-me-input')
		]);

		return redirect()->back();
		
	}

	public function postEditStreamerDetails(Request $request)
	{
		$this->validate($request, [
			'streamer-details-input' => 'required',
		], [
			'required' => 'You must enter in some information before submitting.'
		]);

		Auth::user()->update([
			'streamer_details' => $request->input('streamer-details-input')
		]);

		return redirect()->back();
		
	}

	

	public function getRemoveStream()
	{
		$user = User::where('id', Auth::user()->id)->first();

		if (!$user->getTwitchChannel() && !Auth::user()->getYoutubeId())
		{
			return redirect()->back();
		}

		if (Auth::user()->id !== $user->id)
		{
			return redirect()->back();
		}

		DB::table('users')
			->where('id', Auth::user()->id)
			->update([
				'twitch_url' => '',
				'youtube_url' => '',
			]);

		return redirect()->back();
	}
}