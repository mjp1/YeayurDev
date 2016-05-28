<?php

namespace Yeayurdev\Http\Controllers;

use DB;
use Carbon\Carbon;
use Auth;
use Yeayurdev\Models\User;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function postConfirmNotifications(Request $request)
    {
    	if ($request->ajax()) 
    	{
    		DB::table('notifications_user')
    		->where('user_id', Auth::user()->id)
    		->update([
    			'viewed' => 1
			]);
    	}
    	
    }

    public function postDeleteNotification(Request $request, $username, $notificationId)
    {
    	if ($request->ajax())
    	{
    		DB::table('notifications_user')
	    		->where('user_id', Auth::user()->id)
	    		->where('id', $notificationId)
	    		->delete();
    	}
    }

    public function postDeleteNotificationAll(Request $request)
    {
    	if ($request->ajax()) 
    	{
    		DB::table('notifications_user')
	    		->where('user_id', Auth::user()->id)
	    		->delete();
    	}
    }
}
