<?php

namespace Yeayurdev\Http\Controllers;

use Mail;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Yeayurdev\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectPath = '/main';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
            $message->from('support@yeayur.com', 'Yeayur Support');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('success', 'Please check your email for the password reset link');

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        $user = Auth::user();

        Mail::send('emails.passwordresetconfirm', ['user' => $user], function ($m) use ($user) {
            $m->from('support@yeayur.com', 'Yeayur Support');
            $m->to($user->email);
            $m->subject('Password Reset Confirmation');
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                /*return redirect($this->redirectPath())->with('status', trans($response));*/
                return redirect()->route('profile', ['username' => Auth::user()->username]);

            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);



        

        }
    }
}
