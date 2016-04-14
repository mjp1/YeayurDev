<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use Yeayurdev\Events\UserHasPostedMessage;
use Auth;
use DB;
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
                "postid" => $newMessage->id,
                "name"=> Auth::user()->username,
                "body"=> $request->input('post'),
                "time"=> Carbon::now()->diffForHumans(),
                "image" => Auth::user()->getImagePath()
            ];

            event(new UserHasPostedMessage($newMessage));
        
        }

    }

    public function postEditMessage(Request $request, $id, $postid)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'editpost' => 'required|max:1000',
            ],[
                'required' => 'You have to type something in first!',
            ]);

            DB::table('posts')
                ->where('id', $postid)
                ->where('user_id', Auth::user()->id)
                ->where('profile_id', $id)
                ->update([
                    'body' => $request->input('editpost'),
                ]);

             /**
              *   Create new message variable for the event
              */

            /*$newMessage = [ 
                "id" => $id,
                "name"=> Auth::user()->username,
                "body"=> $request->input('post'),
                "time"=> Carbon::now()->diffForHumans(),
                "image" => Auth::user()->getImagePath()
            ];

            event(new UserHasPostedMessage($newMessage));*/
        
        }
    }

    public function postDeleteMessage(Request $request, $id, $postid)
    {
        if ($request->ajax())
        {
            DB::table('posts')
                ->where('id', $postid)
                ->where('user_id', Auth::user()->id)
                ->where('profile_id', $id)
                ->delete();
        }
    }

    public function getLike($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return redirect()->back();
        }

        if (Auth::user()->hasLikedPost($post)) {
            return redirect()->back();
        }        

        $like = $post->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    public function getUnlike($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return redirect()->back();
        }

        if (!Auth::user()->hasLikedPost($post)) {
            return redirect()->back();
        }        

        DB::table('likeable')
            ->where('user_id', Auth::user()->id)
            ->where('likeable_id', $postId)
            ->delete();

        return redirect()->back();
    }

}
