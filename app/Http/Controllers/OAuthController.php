<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Socialite;
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
        $user = Socialite::driver('twitch')->user();
        $username = $user->getName();

        if (!$user = User::where('username', $username)->first())
        {
            DB::table('users')
                ->where('id',Auth::user()->id)
                ->update([
                    'twitch_username' => $username,
                    'username' => $username
                ]);

            return redirect()->route('oauth.oauthconfirmation');
        }

        return redirect()->route('oauth.error');
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
        Flash::overlay('');

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
