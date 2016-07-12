<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use DB;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Fan;
use Illuminate\Http\Request;

class MainController extends Controller
{	
	public function getIndex()
	{
		$newUsers = User::orderBy('created_at', 'desc')->take(6)->get();
		$newFans = Fan::orderBy('created_at', 'desc')->take(6)->get();
		$topContributors = User::orderBy('user_points', 'desc')->take(6)->get();
		$posts = Post::orderBy('created_at', 'desc')->take(6)->get();
		

		

		
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
		$posts = Post::orderBy('created_at', 'desc')->get(); // Once too many users sign up...paginate and use Masonry JS infinite scroll
		
		return view('main.pages.recentposts')->with('posts', $posts);
	}
}