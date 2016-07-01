<?php

namespace Yeayurdev\Http\Controllers;

use DB;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Yeayurdev\Models\Fan;
use Yeayurdev\Models\User;
use Yeayurdev\Models\Post;
use Yeayurdev\Http\Requests;

class FanPageController extends Controller
{
    public function postCreate(Request $request)
    {
    	if ($request->ajax())
    	{
    		$this->validate($request, [
				'fanpageurl' => 'required|url|twitchUrl'
			],[
				'required' => 'You must enter a valid url.',
				'url' => 'You must enter a valid url.',
			]);

    		$url = $request->input('fanpageurl');

    		$channel = substr($url, strrpos($url, "/") + 1);

            /**
             *  Use Twitch API to get streamer details
             */

            $streamer = json_decode(file_get_contents('https://api.twitch.tv/kraken/users/'.$channel), true);

            $displayName = $streamer['display_name'];
            $bio = $streamer['bio'];
            $logoUrl = $streamer['logo'];

            Fan::create([
                'display_name' => $displayName,
                'bio' => $bio,
                'logo_url' => $logoUrl,
            ]);

    		return response()->json('/fan/'.$displayName);
    		
		}
    }

    public function getFanPage($displayName)
    {
        $fan = Fan::where('display_name', $displayName)->first();

        $posts = Post::notReply()->where('fan_page_id', $fan->id)->orderBy('created_at', 'desc')->get();

        // Return most recent 5 videos by Twitch user

        $videos = json_decode(file_get_contents('https://api.twitch.tv/kraken/channels/'.$fan->display_name.'/videos?limit=5'), true);
        $videos = $videos['videos'];

        return view('profile.fan.index')
            ->with([
                'fan' => $fan,
                'videos' => $videos,
                'posts' => $posts,
            ]);
    }

    public function addFollowFanPage($fan)
    {
        $fan = Fan::where('display_name', $fan)->first();

        /**
         *  Checks if fan page exists
         */
        if (!$fan) {
            return redirect()->back();
        }

        if (Auth::user()->isFollowingFanPage($fan)) {
            return redirect()->back();
        }

        /**
         *   Follow fan page
         */

        DB::table('connections')->insert([
            'user_id' => Auth::user()->id,
            'fan_page_id' => $fan->id,
        ]);

        /* Also add record to users table to be used for indexing */

        DB::table('fans')->where('id', $fan->id)->increment('followers_count', 1);

        return redirect()->back();
    }

    public function removeFollowFanPage($fan)
    {
        $fan = Fan::where('display_name', $fan)->first();

        /**
         *  Checks if fan page exists
         */
        if (!$fan) {
            return redirect()->back();
        }

        if (!Auth::user()->isFollowingFanPage($fan)) {
            return redirect()->back();
        }

        /**
         *   Follow fan page
         */

        DB::table('connections')
            ->where('user_id', Auth::user()->id)
            ->where('fan_page_id', $fan->id)
            ->delete();

        /* Also add record to users table to be used for indexing */

        DB::table('fans')->where('id', $fan->id)->decrement('followers_count', 1);

        return redirect()->back();
    }

    public function postFanPageContent(Request $request, $id)
    {
        $this->validate($request, [
            'fan-page-input' => 'required|max:2000',
        ],[
            'required' => 'You have to type something in first!',
            'max' => 'Must be less than 2,000 characters!',
        ]);

        DB::table('fans')
            ->where('id', $id)
            ->update([
                'body' => $request->input('fan-page-input'),
            ]);

        return redirect()->back();
    }
}
