<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Fan;

class UserListController extends Controller
{
    public function createList(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|max:150',
            'listItem.*' => 'required',
        ],[
            'required' => 'You have to type something in first!',
            'max' => 'List name must be less than 150 characters!',
        ]);
    }
}
