<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Alert;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * ------------------------------------------------------------------------
     * Where to redirect users after login.
     * ------------------------------------------------------------------------.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * ------------------------------------------------------------------------
     * Create a new controller instance.
     * ------------------------------------------------------------------------.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ------------------------------------------------------------------------
     * Handle a login request to the application.
     * ------------------------------------------------------------------------.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials, $request->remember)) {
            if (Auth::user()->active == 1) {
                Alert::success(Auth::user()->name.', bem vindo ao sistema')->autoclose(1000);
                Session::put('skin', Auth::user()->skin);

                return redirect()->route('home');
            } else {
                Alert::error('Lamento, mas este usuário não está ativo no sistema.')->persistent('Ok');

                $this->logout($request);

                return redirect()->route('login');
            }
        }
        Alert::error('Usuário ou senha inválido. Tente novamente.')->persistent('Ok');

        $this->logout($request);

        return redirect()->route('login');
    }
}
