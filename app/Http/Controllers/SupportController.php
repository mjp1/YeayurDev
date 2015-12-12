<?php

namespace Yeayurdev\Http\Controllers;

class SupportController extends Controller
{
	public function getSupport()
	{
		return view('support.index');
	}
}