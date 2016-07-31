<?php

namespace Yeayurdev\Http\Controllers;

use Carbon\Carbon;
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

            // If user exists
            if (User::where('username', $streamer['display_name'])->first())
            {
                return response()->json('/'.$displayName);

            } 

            elseif (Fan::where('display_name', $streamer['display_name'])->first())
            {
                return response()->json('/fan/'.$displayName);
            }

            elseif (!User::where('username', $streamer['display_name'])->first() && !Fan::where('display_name', $streamer['display_name'])->first())
            {
                Fan::create([
                    'display_name' => $displayName,
                    'bio' => $bio,
                    'logo_url' => $logoUrl,
                ]);

                return response()->json('/fan/'.$displayName); 
            }

            
		}
    }

    public function getFanPage($displayName)
    {
        $fan = Fan::where('display_name', $displayName)->first();

        // If fan does not exist, redirect to getProfile method to see if a profile page exists
        if (!$fan)
        {
            return redirect()->action('ProfileController@getProfile', [$displayName]);
        }

        /**
         *  Code for recently_visited table. If user has not previously
         *  visited that profile, create a record. If user has, then  
         *  increment the "times_visited" column.
         */
        if (Auth::check())
        {
            if (!Auth::user()->previouslyVisitedFan($fan)) {

                Auth::user()->addFanPageVisits($fan);
            }

            elseif (Auth::user()->previouslyVisitedFan($fan)) {
                $visits = DB::table('recently_visited')
                    ->where('fan_page_id',$fan->id)
                    ->where('visitor_id',Auth::user()->id)
                    ->increment('times_visited', 1, ['last_visit' => Carbon::now()]);
            }
                
            
        }

        $posts = Post::notReply()->where('fan_page_id', $fan->id)->orderBy('created_at', 'desc')->get();

        // Return most recent 5 videos by Twitch user

        $videos = json_decode(file_get_contents('https://api.twitch.tv/kraken/channels/'.$fan->display_name.'/videos?limit=5'), true);
        $videos = $videos['videos'];

        $tags = DB::table('user_tags')->where('fan_page_id', $fan->id)->lists('tag_name');

        return view('profile.fan.index')
            ->with([
                'fan' => $fan,
                'videos' => $videos,
                'posts' => $posts,
                'tags' => $tags,
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

    // NOT CURRENTLY USED
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

    public function postEditFanTags(Request $request, $id)
    {
        $tags = $request->input('tags');
        $tags = explode(',', $tags);

        DB::table('user_tags')->where('fan_page_id', $id)->delete();

        foreach ($tags as $key => $value)
        {
            DB::table('user_tags')->insert([
                'fan_page_id' => $id,
                'tag_name' => $value,
                'tag_updater_id' => Auth::user()->id,
                'tag_updated' => Carbon::now(),
            ]);
        }

        return redirect()->back();
    }
}
