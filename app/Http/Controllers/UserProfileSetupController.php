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

            if ($request->has('typeDetails.games'))
            {
                return 'games';
            }

            if ($request->has('typeDetails.art'))
            {
                return 'art';
            }
            
        }
    }
}
