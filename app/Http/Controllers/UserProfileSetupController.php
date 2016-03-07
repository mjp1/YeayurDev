<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
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
return $request->all();
            if ($request->all() === "")
            {
              return Response::json('You must select one');  
            }
            
         

            Auth::user()->userType()->create([
                'games' => $request->input('games'),
                'art' => $request->input('art'),
                'music' => $request->input('music'),
                'building_stuff' => $request->input('buildingStuff'),
                'educational' => $request->input('educational'),  


            ]);   

        }
        
    }

    public function postProfileSetup2(Request $request)
    {

    }
}
