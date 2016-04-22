<?php

namespace Yeayurdev\Http\Controllers;

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

	public function getIndex()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(30);

		return view('main.index')
			->with('posts', $posts);
	}
}