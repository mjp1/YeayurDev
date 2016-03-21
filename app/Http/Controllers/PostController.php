<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use Yeayurdev\Events\UserHasPostedMessage;
use Auth;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postMessage(Request $request, $id)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'post' => 'required|max:1000',
            ],[
                'required' => 'You have to type something in first!',
            ]);

                $newMessage = Auth::user()->posts()->create([
                    'body' => $request->input('post'),
                    'profile_id' => $id
                ]);

             /**
              *   Create new message variable for the event
              */

            $newMessage = [ 
                "id" => $id,
                "name"=> Auth::user()->username,
                "body"=> $request->input('post'),
                "time"=> Carbon::now()->diffForHumans(),
                "image" => Auth::user()->getImagePath()
            ];

            event(new UserHasPostedMessage($newMessage));
        
        }

    }

    public function getLike($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return redirect()->back();
        }

        if (Auth::user()->hasLikedPost($post)) {
            dd('already liked');
        }        

        $like = $post->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

}
