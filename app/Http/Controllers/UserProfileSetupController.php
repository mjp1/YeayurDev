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

            /*$this->validate($request, [
                'streamerType.*' => 'in:1,4,5',
            ],[
                'in:' => 'Do not change the values of the checkboxes.'
            ]);*/

            $validator = Validator::make($request->all(), [
                'streamerType.*' => 'required|in:1',
            ]);

            foreach ($streamerType as $key => $value)
            {


                DB::table('user_type')->insert([
                    'user_id' => Auth::user()->id,
                    'type_id' => $value,
                    'created_at' => Carbon::now(),
                ]);
            }

        }
        
    }

    public function postProfileSetup2(Request $request)
    {

    }
}
