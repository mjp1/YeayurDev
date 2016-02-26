<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Socialite;
use Auth;
use DB;
use Session;
use Yeayurdev\Models\User;
use Yeayurdev\Http\Requests;
use Yeayurdev\Http\Controllers\Controller;

class OAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToTwitch()
    {
        return Socialite::driver('twitch')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleTwitchCallback()
    {
        $user = Socialite::driver('twitch')->user();
        $username = $user->getName();

        DB::table('users')
            ->where('id',Auth::user()->id)
            ->update(['twitch_username' => $username]);

        return redirect()->route('auth.oauth')->with('twitch_connected');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToYoutube()
    {
        return Socialite::driver('youtube')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleYoutubeCallback()
    {
        $user = Socialite::driver('youtube')->user();
        $username = $user->getNickname();

        DB::table('users')
            ->where('id',Auth::user()->id)
            ->update(['youtube_username' => $username]);

        return redirect()->route('auth.oauth')->with('youtube_connected');
    }

    public function getOAuth()
    {
        return view('auth.oauth');
    }

}
