<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }

    public function forgotPassword(Request $request)
    {
        return 'Quên mật khẩu';
    }

    public function postLogin(Request $request, Validator $validator)
    {
        if (Auth::attempt(['user_name' => $request->input('name'), 'password' => $request->input('password')])) {
            // Authentication passed...
            return redirect('admin');
        } else {
            $stt = "Thông tin tài khoản hoặc mật khẩu không đúng!";
            return redirect('login')->withInput($request->only('email', 'remember'))->with('status', $stt);
        }
    }
}
