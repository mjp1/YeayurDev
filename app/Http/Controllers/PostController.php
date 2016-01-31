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

        $this->validate($request, [
            'post' => 'required|max:1000',
        ]);

         $newMessage = Auth::user()->posts()->create([
                        'body' => $request->input('post'),
                        'profile_id' => $id
                    ]);

         /**
          *   Create new message variable for the event.
          */

         
        $newMessage = [ 
            "id" => $id,
            "name"=> Auth::user()->username,
            "body"=> $request->input('post'),
            "time"=> Carbon::now()->diffForHumans(),
            "image" => Auth::user()->getImagePath()
        ];

        event(new UserHasPostedMessage($newMessage));
    
        return redirect()->back();
    }

    public function postReply(Request $request, $postId)
    {
        $this->validate($request, [
            "reply-{$postId}" => 'required|max:1000'
        ], [
            'required' => 'The reply body is required.'
        ]);

        $post = Post::notReply()->find($postId);

        if (!$post) {
            return redirect()->back();
        }

        if (!Auth::user()->isFollowing($post->user) && Auth::user()->id !== $post->user->id) {
            return redirect()->back();
        }

        $reply = Post::create([
            'body' => $request->input("reply-{$postId}"),
            'profile_id' => $postId
        ])->user()->associate(Auth::user());

        $post->replies()->save($reply);

        return redirect()->back();
    }
    
}
