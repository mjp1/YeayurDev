<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Socialite;
use Auth;
use DB;
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
        dd($user->getName());
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
        dd($user->getNickname());
    }

    public function getOAuth()
    {
        return view('auth.oauth');
    }

    public function postTwitchOAuth(Request $request, $username)
    {
        if($request->ajax())
        {
            /*$this->validate($request, [
                'username' => 'required|unique:users',
            ], [
                'required' => 'The username'
            ]);*/

            DB::table('users')
                ->where('id',Auth::user()->id)
                ->update(['username' => $username]);
        }
            
    }
}
