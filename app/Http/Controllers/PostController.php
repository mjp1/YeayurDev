<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use Yeayurdev\Events\UserHasPostedMessage;
use Yeayurdev\Events\UserNotificationLike;
use Yeayurdev\Events\UserNotificationPost;
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
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Your post must be less than 1,000 characters!',
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
            ];

            $profileId = $id;

            event(new UserHasPostedMessage($newMessage, $profileId));

            /**
             *  Create new notification to all following users
             */

            // Retrieve a collection of followers for Auth user
            $followers = Auth::user()->followers;
            // Loop through each followers and add their notification to the database
            foreach ($followers as $follower)
            {
                DB::table('notifications_user')
                    ->insert([
                        'user_id' => $follower->id,
                        'notifier_id' => Auth::user()->id,
                        'notification_type' => "Post",
                        'created_at' => Carbon::now()
                    ]);
            }

            $newNotification = [ 
                "username" => Auth::user()->username,
                "type" => "Post",
                "time" => Carbon::now()->diffForHumans(),
                "image" => Auth::user()->getImagePath()
            ];

            event(new UserNotificationPost($newNotification));
        
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
        
        }
    }

    public function postReplyMessage(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                "replyBody" => 'required|max:1000',
            ],[
                'required' => 'You must type something in first!',
                'max' => 'Max 1,000 characters allowed.',
            ]);

            $post = Post::notReply()->find($postId);

            $reply = Post::create([
                'user_id' => Auth::user()->id,
                'parent_id' => $postId,
                'body' => $request->input("replyBody"),
                'created_at' => Carbon::now(),
            ]);
        }
    }

    public function postUpvote(Request $request, $postId)
    {
        if ($request->ajax())
        {
            // Remove any previous downvotes
            DB::table('post_vote')
                ->where([
                    'user_id' => Auth::user()->id,
                    'post_id' => $postId,
                    'down_vote' => 1,
                ])->delete();

            // Check if user has previously upvoted this post
            $upExists = DB::table('post_vote')
                        ->where([
                            'user_id' => Auth::user()->id,
                            'post_id' => $postId,
                            'up_vote' => 1,
                        ])->first();

            if ($upExists)
            {
                return response()->json("You can only upvote once!");
            }

            DB::table('post_vote')->insert([
                'user_id' => Auth::user()->id,
                'post_id' => $postId,
                'up_vote' => 1,
                'created_at' => Carbon::now()
            ]);

            $upVote = DB::table('post_vote')->where('post_id', $postId)->sum('up_vote');
            $downVote = DB::table('post_vote')->where('post_id', $postId)->sum('down_vote');
            $count = $upVote - $downVote;

            return response()->json(['count' => $count]);
                
        }
    }

    public function postDownvote(Request $request, $postId)
    {
        if ($request->ajax())
        {
            // Remove any previous upvotes
            DB::table('post_vote')
                ->where([
                    'user_id' => Auth::user()->id,
                    'post_id' => $postId,
                    'up_vote' => 1,
                ])->delete();

            // Check if user has previously downvoted this post
            $downExists = DB::table('post_vote')
                        ->where([
                            'user_id' => Auth::user()->id,
                            'post_id' => $postId,
                            'down_vote' => 1,
                        ])->first();

            if ($downExists)
            {
                return response()->json("You can only downvote once!");
            }

            DB::table('post_vote')->insert([
                'user_id' => Auth::user()->id,
                'post_id' => $postId,
                'down_vote' => 1,
                'created_at' => Carbon::now()
            ]);

            $upVote = DB::table('post_vote')->where('post_id', $postId)->sum('up_vote');
            $downVote = DB::table('post_vote')->where('post_id', $postId)->sum('down_vote');
            $count = $upVote - $downVote;

            return response()->json(['count' => $count]);
        }
    }

}
