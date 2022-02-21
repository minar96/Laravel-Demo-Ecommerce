<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        //find user by this request email
        $user =  User::where('email', $request->email)->first();

        if ($user->status == 1) {
            //login user
            if (Auth::guard('web')->attempt(['email'=> $request->email, 'password' => $request->password], $request->remember)) {
                return redirect()->intended(route('index'));
            }else{
               session()->flash('error', 'Invalid Login');
                return back(); 
            }
        }else{

            if (!is_null($user)) {
               $user->notify(new VerifyRegistration($user));
                session()->flash('success', 'A New confermation email send your email...please check your email');
                return redirect('/');
            }else{
                session()->flash('error', 'Please Sign in First');
                return redirect()->route('login');
            }

        }
    }
}
