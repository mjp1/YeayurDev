<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
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
    /*public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }*/

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
/*    public function handleGoogleCallback()
    {
        $user = $this->socialite->driver('google')->user()->with('youtube');

        return $user; 
    }*/

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
