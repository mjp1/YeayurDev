<?php

/**
 *  CONTROLLER NO LONGER USED
 */

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Models\User;
use Yeayurdev\Models\Fan;
use Illuminate\Http\Request;


class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = trim($request->input('query'));

		if (!$query) {
			return redirect()->back();
		}

		// Check if request finds a match in the User model
		$users = User::where('username', 'LIKE', "%{$query}%")->get();

		// Check if request finds a match in the Fan model
		$fans = Fan::where('display_name', 'LIKE', "%{$query}%")->get();

		if (!$users->count() && !$fans->count())
		{
			return view('search.results')->with('users', $users)->with('fans', $fans);	
		} 

		elseif ($users->count() && $fans->count())
		{
			return view('search.results')
				->with([
					'users' => $users,
					'fans' => $fans,
				]);
		}

		elseif ($users->count())
		{
			return redirect()->route('profile', ['username' => $request->input('query')]);
		}
		
		elseif ($fans->count())
		{
			return redirect()->route('fan', ['displayName' => $request->input('query')]);
		}
		
	}
}