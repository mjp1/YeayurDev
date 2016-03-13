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
            $gameInfo = Input::get('gameInfo');
            $artInfo = Input::get('artInfo');
            $musicInfo = Input::get('musicInfo');
            $buildingStuffInfo = Input::get('buildingStuffInfo');
            $educationalInfo = Input::get('educationalInfo');

            
                $this->validate($request, [
                    'gameInfo' => 'required',
                ], [
                    'required' => 'You must enter information on the games you stream.',
                ]);

                return $gameInfo; 
            

            if ($artInfo)
            {
                $this->validate($request, [
                    'artInfo' => 'required',
                ], [
                    'required' => 'You must enter information on the art you stream.',
                ]);

                return $artInfo; 
            }

            if ($musicInfo)
            {
                $this->validate($request, [
                    'musicInfo' => 'required',
                ]);

                return $musicInfo; 
            }

            if ($buildingStuffInfo)
            {
                $this->validate($request, [
                    'buildingStuffInfo' => 'required',
                ]);

                return $buildingStuffInfo; 
            }

            if ($educationalInfo)
            {
                $this->validate($request, [
                    'educationalInfo' => 'required',
                ]);

                return $educationalInfo; 
            }
            
        }
    }
}
