<?php

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Models\User;
use Illuminate\Http\Request;


class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = trim($request->input('query'));

		if (!$query) {
			return redirect()->back();
		}

		$users = User::where('username', 'LIKE', "%{$query}%")->get();

		return view('search.results')->with('users', $users);
	}
}