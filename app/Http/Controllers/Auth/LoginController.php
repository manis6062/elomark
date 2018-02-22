<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your dashboard screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // public $maxAttempts = 5; // change to the max attemp you want.
    // public $decayMinutes = 1; // change to the minutes you want.

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



   protected function hasTooManyLoginAttempts(Request $request)
    {
        // $lockoutTime = 10 / 60;    //lockout after 10 seconds (setting is in minutes hence devision by 60 for setting the time in seconds)

        $maxLoginAttempts = 5;    //lockout after 5 attempts

        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts
        );
    }
}
