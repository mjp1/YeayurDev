<?php

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Models\User;
use Illuminate\Http\Request;


class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = $request->input('query');

		if (!$query) {
			return redirect()->route('main');
		}

		$users = User::where('username', 'LIKE', "%{$query}%")->get();

		return view('search.results')->with('users', $users);
	}
}