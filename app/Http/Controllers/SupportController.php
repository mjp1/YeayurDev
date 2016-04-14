<?php

namespace Yeayurdev\Http\Controllers;

use Illuminate\Http\Request;
use Yeayurdev\Models\User;
use Mail;
use Carbon\Carbon;
use Auth;


class SupportController extends Controller
{
	public function getSupport()
	{
		return view('support.index');
	}

	public function postSupport(Request $request)
	{
		$this->validate($request, [
			'support_content' => 'required',
		]);

		/*Send user a confirmation email that we have received their support request*/
		
		/*Mail::send('email.support.confirmation')*/
	
		/*Send internal mail to the support@yeayur.com inbox*/

		Mail::send('emails.support.internal', [
			'username' => Auth::user()->username,
			'email' => Auth::user()->email,
			'supportContent' => $request->input('support_content'),
			'timestamp' => Carbon::now(),
			],
			function ($message)
			{
				$message->from('support@yeayur.com', 'Yeayur Support Request');
				$message->to('support@yeayur.com')->subject('Yeayur Support Request');
			}
			
		);

		return redirect()->route('support')->with('success', 'Your support request has been sent');
	}

	public function getPublicSupport()
	{
		return view('support.publicsupport');
	}

	public function postPublicSupport(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|email',
			'support_content' => 'required',
		]);

		/*Send user a confirmation email that we have received their support request*/
		
		/*Mail::send('email.support.confirmation')*/
	
		/*Send internal mail to the support@yeayur.com inbox*/

		Mail::send('emails.support.public', [
			'email' => $request->input('email'),
			'supportContent' => $request->input('support_content'),
			'timestamp' => Carbon::now(),
			],
			function ($message)
			{
				$message->from('support@yeayur.com', 'Yeayur Public Support Request');
				$message->to('support@yeayur.com')->subject('Yeayur Public Support Request');
			}
			
		);

		return redirect()->route('support.public')->with('success', 'Your support request has been sent');
	}

	public function getRegistrationSupport()
	{
		return view('support.registrationsupport');
	}
}