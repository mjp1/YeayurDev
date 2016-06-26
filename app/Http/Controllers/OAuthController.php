<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Socialite;
use Carbon\Carbon;
use Auth;
use DB;
use Session;
use Flash;
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
        $twitchUser = Socialite::driver('twitch')->user();
        $username = $twitchUser['display_name'];

        // If no match in database for Twitch username then register the user
        if (!$username = User::where('username', $username)->first())
        {
            $user = User::create([
                'email' => $twitchUser['email'],
                'username' => $twitchUser['display_name'],
                'twitch_username' => $twitchUser['display_name'],
                'image_path' => $twitchUser['logo'],
                'about_me' => $twitchUser['bio']
            ]);

            Auth::login($user, true);
            
            // Store Twitch Oauth token

            DB::table('oauth_tokens')->insert([
                'user_id' => Auth::user()->id,
                'Twitch' => $twitchUser->token,
                'Twitch_refresh' => $twitchUser->refreshToken,
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('profile', ['username' => Auth::user()->username]);
        }

        // If the user exists in the database, authenticate and redirect to profile
        $user = User::where('username', $twitchUser['display_name'])->first();
        Auth::login($user, true);
        return redirect()->route('profile', ['username' => Auth::user()->username]);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    /*public function redirectToYoutube()
    {
        return Socialite::driver('youtube')->redirect();
    }*/

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    /*public function handleYoutubeCallback()
    {
        $user = Socialite::driver('youtube')->user();
        $username = $user->getNickname();

        DB::table('users')
            ->where('id',Auth::user()->id)
            ->update([
                'youtube_username' => $username,
                'username' => $username
            ]);

        return redirect()->route('oauth.oauthconfirmation');
    }*/

    public function getOAuth()
    {
        return view('oauth.oauth');
    }

    public function getOAuthError()
    {
        return view('oauth.oautherror');
    }

    public function getOAuthConfirmation()
    {
        return view('oauth.oauthconfirmation');
    }

    public function getRouteOAuthToProfile()
    {
        Flash::overlay('Go ahead and look around. To edit your profile, look for the edit icons as you hover. Happy streaming!', 'Welcome to Yeayur!');

        return redirect()->route('profile', ['username' => Auth::user()->username]);
    }

    /*public function postPrimarySelection(Request $request)
    {*/
        /**
         *   Validate radio selection
         */
        

       /* $this->validate($request, [
            'primaryService' => 'required',
        ]);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['primary_service' => $request->input('primaryService')]);
            
      
    }*/

}
