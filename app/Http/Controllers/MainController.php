<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use DB;
use Mail;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Fan;
use Illuminate\Http\Request;

class MainController extends Controller
{	
	public function getIndex()
	{
		$newUsers = User::orderBy('created_at', 'desc')->take(8)->get();
		$newFans = Fan::orderBy('created_at', 'desc')->take(8)->get();
		$topContributors = User::orderBy('user_points', 'desc')->take(8)->get();
		$posts = Post::notReply()->orderBy('created_at', 'desc')->take(10)->get();
		

		

		
		return view('main.index')
			->with([
				'newUsers' => $newUsers,
				'newFans' => $newFans,
				'topContributors' => $topContributors,
				'posts' => $posts,
			]);
	}

	public function getProfilesPage()
	{
		$newUsers = User::orderBy('created_at', 'desc')->get(); // Once too many users sign up...paginate and use Masonry JS infinite scroll
		
		return view('main.pages.profiles')->with('newUsers', $newUsers);
	}

	public function getFanPages()
	{
		$newFans = Fan::orderBy('created_at', 'desc')->get(); // Once too many users sign up...paginate and use Masonry JS infinite scroll
		
		return view('main.pages.fanpages')->with('newFans', $newFans);
	}

	public function getTopContributorsPage()
	{
		$topContributors = User::orderBy('user_points', 'desc')->get(); // Once too many users sign up...paginate and use Masonry JS infinite scroll
		
		return view('main.pages.topcontributors')->with('topContributors', $topContributors);
	}

	public function getRecentPostsPage()
	{
		$posts = Post::notReply()->orderBy('created_at', 'desc')->get(); // Once too many users sign up...paginate and use Masonry JS infinite scroll
		
		return view('main.pages.recentposts')->with('posts', $posts);
	}

	public function sendEmail()
	{
		$users = User::all();

		foreach ($users as $user)
		{
			Mail::send('emails.marketing.08102016', ['user' => $user], function($m) use ($user) {
	        	$m->from('contact@yeayur.com', 'Yeayur Team');
	        	$m->to($user->email);
	        	$m->subject('Thanks For Being Part of Yeayur!');
	        });
		}
	}

}