<?php

namespace Yeayurdev\Http\Controllers;

use Yeayurdev\Events\UserNotificationFollow;

use DB;
use Carbon\Carbon;
use Auth;
use Yeayurdev\Models\User;
use Yeayurdev\Http\Request;
use Yeayurdev\Http\Controllers\Controller;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAddFollowing($username)
    {
        $user = User::where('username', $username)->first();

        /**
         *  Checks if user exists
         */
        if (!$user) {
            return redirect()->route('main');
        }

        if (Auth::user()->isFollowing($user)) {
            return redirect()->route('main');
        }

        /**
         *   Follow user
         */

        Auth::user()->addConnection($user);

        /* Also add record to users table to be used for indexing */

        DB::table('users')->where('id', $user->id)->increment('followers_count', 1);

        /**
         *   Create notification record
         */

        DB::table('notifications_user')
            ->insert([
                'user_id' => $user->id,
                'notifier_id' => Auth::user()->id,
                'notification_type' => "Follow",
                'created_at' => Carbon::now()
            ]);

        /**
         *  Create notification event
         */

        $newNotification = [ 
            "username" => Auth::user()->username,
            "type" => "Follow",
            "time"=> Carbon::now()->diffForHumans(),
            "image" => Auth::user()->getImagePath()
        ];

        $followId = $user->id;

        event(new UserNotificationFollow($newNotification, $followId));

        return redirect()->route('profile', ['username' => $user->username]);
    }

    public function getRemoveFollowing($username)
    {
        $user = User::where('username', $username)->first();

        /**
         *  Checks if user exists
         */
        if (!$user) {
            return redirect()->route('main');
        }

        if (!Auth::user()->isFollowing($user)) {
            return redirect()->route('main');
        }

        /* Also remove record from users table to be used for indexing */

        DB::table('users')->where('id', $user->id)->decrement('followers_count', 1);


        Auth::user()->removeConnection($user);

        return redirect()->back();
    }

}
