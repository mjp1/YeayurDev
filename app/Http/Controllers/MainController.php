<?php

namespace Yeayurdev\Http\Controllers;


use Yeayurdev\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
	public function getMain()
	{
		return view('templates.main.main');
	}


}