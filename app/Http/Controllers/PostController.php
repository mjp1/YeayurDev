<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
use Yeayurdev\Events\UserHasPostedMessage;
use Yeayurdev\Events\UserNotificationLike;
use Yeayurdev\Events\UserNotificationPost;
use Yeayurdev\Events\FanNotificationPost;
use Auth;
use DB;
use Input;
use Image;
use Storage;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Fan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Posts new feedback on $user's profile page

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
             *  Add notification in database for all followers of $user
             */

            $user = User::where('id', $id)->first();
            $profileName = $user->username;

            // Retrieve a collection of followers for $user
            $followers = $user->followers;
            // Loop through each follower and add their notification to the database
            foreach ($followers as $follower)
            {
                if ($follower->id !== Auth::user()->id)
                {
                    DB::table('notifications_user')
                        ->insert([
                            'user_id' => $follower->id,
                            'notifier_id' => Auth::user()->id, // User performing the action that causes the notification
                            'notification_type' => "Post",
                            'profile_name' => $profileName,
                            'created_at' => Carbon::now()
                        ]);
                }
                
            }

            // Add notification to database for $user
            DB::table('notifications_user')->insert([
                'user_id' => $user->id,
                'notifier_id' => Auth::user()->id, // User performing the action that causes the notification
                'notification_type' => "Post",
                'profile_name' => $profileName,
                'created_at' => Carbon::now()
            ]);

             /**
              *   Create realtime notification in body of profile page
              */

            $newMessage = [ 
                "id" => $id,
                "postid" => $newMessage->id,
                "name"=> Auth::user()->username,
                "time"=> Carbon::now()->diffForHumans(),
            ];

            $profileId = $id;

            event(new UserHasPostedMessage($newMessage, $profileId));

            // Create realtime notification for followers' navbar alerts

            $newNotification = [ 
                "username" => Auth::user()->username,
                "type" => "Post",
                "time" => Carbon::now()->diffForHumans(),
                "image" => Auth::user()->getImagePath(),
                "profile" => $profileName,
            ];

            event(new UserNotificationPost($newNotification, $profileId));
        
        } 
    }

    public function postFanMessage(Request $request, $id)
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
                'fan_page_id' => $id
            ]);

            /**
             *  Create new notification to all following users
             */

            // Retrieve a collection of followers for Auth user
            $fan = Fan::where('id', $id)->first();

            $followers = $fan->followers;
            // Loop through each followers and add their notification to the database
            foreach ($followers as $follower)
            {
                if ($follower->id !== Auth::user()->id)
                {
                    DB::table('notifications_user')
                        ->insert([
                            'user_id' => $follower->id,
                            'notifier_id' => Auth::user()->id,
                            'fan_page' => $fan->display_name, 
                            'notification_type' => "Fan",
                            'created_at' => Carbon::now()
                        ]);  
                }
                 
            }

            /**
             *   Create realtime notification in body of profile page
             */

            $newMessage = [ 
                "id" => $id,
                "postid" => $newMessage->id,
                "name"=> Auth::user()->username,
                "time"=> Carbon::now()->diffForHumans(),
            ];

            $profileId = $id;

            event(new UserHasPostedMessage($newMessage, $profileId));

             /**
              *   Notifies all users following this fan page that new content has been posted
              *   In navbar alerts
              */

            $newNotification = [ 
                "username"=> Auth::user()->username,
                "fanPage" => $fan->display_name,
                "image" => Auth::user()->getImagePath(),
                "time"=> Carbon::now()->diffForHumans(),
            ];

            $profileId = $id;

            event(new FanNotificationPost($newNotification, $profileId));
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
