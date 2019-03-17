<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
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
        if ($request->wantsJson()) {
            $auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if ($auth) {
                $return = ["success" => true, "token" => Auth::user()->api_token];
                return response()->json($return);
            } else {
                return response('Unauthorized.', 401);
            }
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'staff' => true], true)) {
                return redirect()->intended('dashboard');
            } else {
                return redirect('/');
            }
        }
    }
}
