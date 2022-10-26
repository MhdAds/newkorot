<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login_page()
    {
        return view('dashboard.auth.login');
    }


    public function login(Request $request)
    {
        // dd('dd');
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);


        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('dashboard.home')->withSuccess('مرحباً ' . Auth::guard('web')->user()->name);;
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Session::flush();
        Session::regenerate();
        return redirect('dashboard/login');
    }

    public function forgot_password_page()
    {
        return view('dashboard.auth.passwords.email');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('staff')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password_token($token)
    {
        return view('dashboard.auth.passwords.reset', ['token' => $token]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::broker('staff')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('dashboard.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
