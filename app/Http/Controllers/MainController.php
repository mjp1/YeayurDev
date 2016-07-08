<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use DB;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{	
	public function getIndex()
	{
		return view('main.index');
	}
}