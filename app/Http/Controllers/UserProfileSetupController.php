<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use DB;
use Validator;
use Carbon\Carbon;
use Yeayurdev\Http\Requests;
use Illuminate\Support\Facades\Input;
use Yeayurdev\Http\Controllers\Controller;

class UserProfileSetupController extends Controller
{
    /*Methods for initial profile setup from modal inputs*/

    public function postProfileSetup1(Request $request)
    {
        if ($request->ajax())
        {
            /*Create record in UserType Model with the values from the streamerType checkboxes*/

            $streamerType = Input::get('streamerType');

            $this->validate($request, [
                'streamerType' => 'required',
                'streamerType.*' => 'required|in:1,2,3,4,5',
            ],[
                'required' => 'You must choose at least one.',
                'in' => 'There is an error with your selection.',
            ]);

        }
        
    }

    public function postProfileSetup2(Request $request)
    {
        if ($request->ajax())
        {
            $typeDetails = Input::get('typeDetails');      

           
                $this->validate($request, [
                    'typeDetails.*.*' => 'required|max:50'
                ],[
                    'required' => 'You must type in some keywords to continue.',
                    'max' => 'Your input must be less than 50 characters.',
                ]);
                  

            if ($request->has('typeDetails.games'))
            {
                $gameInfo = Input::get('typeDetails.games');

                foreach ($gameInfo as $key => $value)
                {
                    DB::table('user_type')->insert([
                        'user_id' => Auth::user()->id,
                        'type_id' => '1',
                        'user_type_details' => $value,
                        'created_at' => Carbon::now()
                    ]);   
                }
                
            }

            if ($request->has('typeDetails.art'))
            {
                $artInfo = Input::get('typeDetails.art');

                foreach ($artInfo as $key => $value)
                {
                    DB::table('user_type')->insert([
                        'user_id' => Auth::user()->id,
                        'type_id' => '2',
                        'user_type_details' => $value,
                        'created_at' => Carbon::now()
                    ]);

                }
            }

            if ($request->has('typeDetails.music'))
            {
                $musicInfo = Input::get('typeDetails.music');

                foreach ($musicInfo as $key => $value)
                {
                    DB::table('user_type')->insert([
                        'user_id' => Auth::user()->id,
                        'type_id' => '3',
                        'user_type_details' => $value,
                        'created_at' => Carbon::now()
                    ]);

                }
            }

            if ($request->has('typeDetails.buildingStuff'))
            {
                $buildingStuffInfo = Input::get('typeDetails.buildingStuff');

                foreach ($buildingStuffInfo as $key => $value)
                {
                    DB::table('user_type')->insert([
                        'user_id' => Auth::user()->id,
                        'type_id' => '4',
                        'user_type_details' => $value,
                        'created_at' => Carbon::now()
                    ]);

                }
            }

            if ($request->has('typeDetails.educational'))
            {
                $educationalInfo = Input::get('typeDetails.educational');

                foreach ($educationalInfo as $key => $value)
                {
                    DB::table('user_type')->insert([
                        'user_id' => Auth::user()->id,
                        'type_id' => '5',
                        'user_type_details' => $value,
                        'created_at' => Carbon::now()
                    ]);

                }
            }

           
            
        }
    }

    public function postProfileSetup3(Request $request)
    {


        if ($request->ajax())
        {

/*
            $this->validate($request, [
                'aboutMe' => 'alpha_dash',
                'systemSpecs' => 'alpha_dash',
                'streamSchedule' => 'alpha_dash',
            ],[
                'alpha_dash' => 'You may only use letters, numbers, dashes, and underscores.'
            ]);
*/


            DB::table('user_optional_details')
                ->insert([
                    'user_id' => Auth::user()->id,
                    'system_specs' => $request->input('systemSpecs'),
                    'stream_schedule' => $request->input('streamSchedule'),
                    'updated_at' => Carbon::now(),
                ]);

            
        }
        return Auth::user()->username;
    }
}
