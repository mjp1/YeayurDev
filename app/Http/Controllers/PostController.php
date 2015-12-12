<?php

namespace Yeayurdev\Http\Controllers;

use Auth;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postMessage(Request $request, $id)
    {
        $this->validate($request, [
            'post' => 'required|max:1000',
        ]);

        Auth::user()->posts()->create([
            'body' => $request->input('post'),
            'profile_id' => $id
        ]);
    
        return redirect()->back();
    }
}
