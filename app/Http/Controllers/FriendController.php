<?php

namespace Yeayurdev\Http\Controllers;

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
         *  Checks user is trying to add self as a connection
         */


        Auth::user()->addConnection($user);

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

        /**
         *  Checks user is trying to add self as a connection
         */


        Auth::user()->removeConnection($user);

        return redirect()->route('profile', ['username' => Auth::user()->username]);
    }

}
