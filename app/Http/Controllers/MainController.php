<?php

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
	public function getMain()
	{
		$posts = Post::orderBy('created_at', 'desc')->get();

		return view('templates.main.main')
			->with([
				'posts' => $posts
			]);
		
	}


}