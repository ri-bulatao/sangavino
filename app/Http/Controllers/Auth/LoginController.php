<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  
    use AuthenticatesUsers;

   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
         // redirect to desired page by specific role allowed by GATE
         $credentials = $request->only('email', 'password');
     
         if(Auth::attempt($credentials) && $user->is_activated) 
         {
            $request->session()->regenerate();

            return match($user->role->name) {
               'admin' =>to_route('admin.dashboard.index'),
               'secretary' =>to_route('secretary.dashboard.index'),
               'resident' => to_route('resident.requests.index'),
            };
         } 
         else if (! $user->hasVerifiedEmail()) {
            $request->session()->flush();
            return redirect('/login')->with('error', 'Your email is not yet verified, if request has expired please contact the administrator.');
         } else
         {
            $request->session()->flush();
            return redirect('/login')->with('error', 'Unauthorized User');
         }
    }
}