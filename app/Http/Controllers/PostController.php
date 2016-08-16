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
use Mail;
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
                'post' => 'required|max:2000',
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Your post must be less than 2,000 characters!',
            ]);
            
            $newMessage = Auth::user()->posts()->create([
                'body' => $request->input('post'),
                'profile_id' => $id
            ]);

            $post = Post::where('id', $newMessage->id)->first();

            // Add reputation point to Auth user
            Auth::user()->increment('user_points', 1);

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

            // Check if user has immediate email notification and send email if true
            if ($user->post_notification === "Immediately")
            {
                $poster = User::where('id', Auth::user()->id)->first();
                // Send email
                Mail::send('emails.notifications.immediate', ['user' => $user, 'poster' => $poster, 'post' => $post], function($m) use ($user) {
                    $m->from('contact@yeayur.com', 'Yeayur Contact');
                    $m->to($user->email);
                    $m->subject('You Have Received a New Post');
                });
            }
        
        } 
    }

    public function postFanMessage(Request $request, $id)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'post' => 'required|max:2000',
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Your post must be less than 2,000 characters!',
            ]);
            
            $newMessage = Auth::user()->posts()->create([
                'body' => $request->input('post'),
                'fan_page_id' => $id
            ]);

            // Add reputation point to Auth user
            Auth::user()->increment('user_points', 1);

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

    public function postEditMessage(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'editpost' => 'required|max:2000',
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Your post must be less than 2,000 characters!'
            ]);

            if (!DB::table('posts')->where('id', $postId)->where('user_id', Auth::user()->id))
            {
                return redirect()->back();
            }

            DB::table('posts')
                ->where('id', $postId)
                ->where('user_id', Auth::user()->id)
                ->update([
                    'body' => $request->input('editpost'),
                ]);
        
        }
    }

    public function postDeleteMessage(Request $request, $postId)
    {
        if ($request->ajax())
        {
            if (!DB::table('posts')->where('id', $postId)->where('user_id', Auth::user()->id))
            {
                return redirect()->back();
            }

            // Delete post
            DB::table('posts')
                ->where([
                    'id' => $postId,
                    'user_id' => Auth::user()->id,
                ])->delete();

            // Delete all replies to this post
            DB::table('posts')
                ->where([
                    'parent_id' => $postId,
                ])->delete();
        }
    }

    public function postReportMessage(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $userId = Post::where('id', $postId)->lists('user_id');
            $user = User::where('id', $userId)->first();
            $reporter = User::where('id', Auth::user()->id)->first();
            $post = Post::where('id', $postId)->first();

            Mail::send('emails.reportpost', ['reporter' => $reporter, 'user' => $user, 'post' => $post], function($m) {
                $m->from('support@yeayur.com');
                $m->to('support@yeayur.com');
                $m->subject('Reporting A Post');
            });
        }
    }

    public function postReplyMessage(Request $request, $postId)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                "replyBody" => 'required|max:2000',
            ],[
                'required' => 'You must type something in first!',
                'max' => 'Max 2,000 characters allowed.',
            ]);

            $reply = Post::create([
                'user_id' => Auth::user()->id,
                'parent_id' => $postId,
                'body' => $request->input("replyBody"),
                'created_at' => Carbon::now(),
            ]);

            // Send email notification for replies
            
            $replier = User::where('id', Auth::user()->id)->first();

            $post = Post::where('id', $postId)->first();

            $profile = User::where('id', $post->profile_id)->first();

            $user = User::where('id', $post->user_id)->first();


            Mail::send('emails.notifications.postreply', ['user' => $user, 'profile' => $profile, 'replier' => $replier, 'reply' => $reply], function($m) use ($user) {
                $m->from('contact@yeayur.com', 'Yeayur Contact');
                $m->to($user->email);
                $m->subject('You Have Received A New Reply');
            });
            
        }
    }

    public function postEditReply(Request $request, $replyId)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'editreply' => 'required|max:2000',
            ],[
                'required' => 'You have to type something in first!',
                'max' => 'Your post must be less than 2,000 characters!'
            ]);

            if (!DB::table('posts')->where('id', $replyId)->where('user_id', Auth::user()->id))
            {
                return redirect()->back();
            }

            DB::table('posts')
                ->where('id', $replyId)
                ->where('user_id', Auth::user()->id)
                ->update([
                    'body' => $request->input('editreply'),
                ]);
        }
    }

    public function postDeleteReply(Request $request, $replyId)
    {
        if ($request->ajax())
        {
            if (!DB::table('posts')->where('id', $replyId)->where('user_id', Auth::user()->id))
            {
                return redirect()->back();
            }

            DB::table('posts')
                ->where([
                    'id' => $replyId,
                    'user_id' => Auth::user()->id,
                ])->delete();
        }
    }

    public function postUpvote(Request $request, $postId)
    {
        if ($request->ajax())
        {
            // Remove any previous downvotes by Auth user
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

            $post = Post::where('id', $postId)->first();
            // Check if user is trying to vote on own post
            if ($post->user->id == Auth::user()->id)
            {
                return response()->json('You cannot vote on your own posts!');
            }

            // Add reputation point to user who created post
            $user = User::where('id', $post->user->id)->increment('user_points', 1);

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
            // Remove any previous upvotes by Auth user
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

            $post = Post::where('id', $postId)->first();
            // Check if user is trying to vote on own post
            if ($post->user->id == Auth::user()->id)
            {
                return response()->json('You cannot vote on your own posts!');
            }

            // Add reputation point to user who created post
            $user = User::where('id', $post->user->id)->decrement('user_points', 1);

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
