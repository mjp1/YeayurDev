<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use Yeayurdev\Events\UserHasPostedMessage;
use Auth;
use DB;
use Input;
use Image;
use Storage;
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
                'post-img' => 'image|max:4999'
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Image size must be less than 5MB!',
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
        
        } else {

            $this->validate($request, [
                    'post' => 'required|max:1000',
                    'post-img' => 'image|max:4999',
                ],[
                    'required' => 'You have to type something in first!',
                    'max' => 'Image size must be less than 5MB!',
                ]);

            $extension = Input::file('post-img')->getClientOriginalExtension();
            $fileName = rand(11111,999999999).'.'.$extension;
           
            $image = Image::make($request->file('post-img'))
                ->orientate()
                ->resize(300, null, function ($constraint) { 
                    $constraint->aspectRatio();
                });

            $image = $image->stream();

            $s3 = \Storage::disk('s3');
            $filePath = '/images/posts/'.$fileName;

            $s3->put($filePath, $image->__toString(), 'public');

            $newMessage = Auth::user()->posts()->create([
                'body' => $request->input('post'),
                'image_path' => $fileName,
                'profile_id' => $id
            ]);

                 /**
                  *   Create new message variable for the event
                  */

               /* $newMessage = [ 
                    "id" => $id,
                    "postid" => $newMessage->id,
                    "name"=> Auth::user()->username,
                    "body"=> $request->input('post'),
                    "time"=> Carbon::now()->diffForHumans(),
                    "image" => Auth::user()->getImagePath(),
                    "postimg" => 'https://s3-us-west-2.amazonaws.com/'.env('S3_BUCKET').'/images/posts/'.$fileName,
                ];

                event(new UserHasPostedMessage($newMessage));*/

                return redirect()->back();
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
            DB::table('posts')
                ->where('id', $postid)
                ->where('user_id', Auth::user()->id)
                ->where('profile_id', $id)
                ->delete();
    }

    public function postLike(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $post = Post::find($postId);

            if (!$post) {
                return redirect()->back();
            }

            if (Auth::user()->hasLikedPost($post)) {
                return redirect()->back();
            }  

            if (Auth::user()->id === $post->user->id)
            {
                return redirect()->back();
            }

            $like = $post->likes()->create([]);
            Auth::user()->likes()->save($like);
        }
    }

    public function postUnlike(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $post = Post::find($postId);

            if (!$post) {
                return redirect()->back();
            }

            if (!Auth::user()->hasLikedPost($post)) {
                return redirect()->back();
            }     

            if (Auth::user()->id === $post->user->id)
            {
                return redirect()->back();
            }   

            DB::table('likeable')
                ->where('user_id', Auth::user()->id)
                ->where('likeable_id', $postId)
                ->delete();
        }
    }

}
