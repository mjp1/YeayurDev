<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use DB;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;


class MainController extends Controller
{

	public function getPublicIndex()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(30);
		return view('main.public')
			->with('posts', $posts);
	}
	
	public function getDiscoverConnections()
	{
		
		return Auth::user()->followerId();
	}

	public function getDiscoverCommunity()
	{
		$communityPosts = Post::orderBy('created_at', 'desc')->paginate(30);

		return view('main.discover.community')
			->with([
				'communityPosts' => $communityPosts,
			]);
	}
}