<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = '/home';
    public function authenticated()
    {
        if(Auth::user()->role == 'admin'){
            return redirect('admin/dashboard')->with('message', 'Welcome back Admin');
        }
        elseif(Auth::user()->role == 'teacher'){
            return redirect('teacher/dashboard')->with('message', 'Login was Authorized');
        }
        elseif(Auth::user()->role == 'student'){
            return redirect('student/dashboard')->with('message', 'Login was Authorized');
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        if (is_string($request->get('email'))){
            return ['username'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return $request->only($this->username(), 'password');
    }
}
