<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    
    /**
     * Mark the user's email address as verified.
     */
    public function verify(Request $request, User $user)
    {
        if (! URL::hasValidSignature($request)) {
            return view('auth.verification.verification', ['status' => 'invalid']);
        }

        if ($user->hasVerifiedEmail()) {
            return view('auth.verification.verification', ['status' => 'already_verified']);
        }

        $user->markEmailAsVerified();
        
        $user->is_activated = 1;

        $user->save();

        event(new Verified($user));
        
        // Authenticate the user
        Auth::login($user);

        return view('auth.verification.verification', ['status' => 'verified']);
    }
}
