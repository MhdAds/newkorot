<?php

namespace App\Http\Controllers\Api\Merchant\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FirebaseToken;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


use Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firebase_token' => 'required|string|min:8',
            'email' => 'required',
            'password' => 'nullable'

        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }


        $user = User::where('email', $request->email)->orWhere('phone', $request->email)->get()->first();
        if ($user == null || !Hash::check($request->password, $user->password)) {
            return res(null, 0, 'بيانات الدخول غير صحيحة', 503);
        }

        if ($user->status == User::STATUS_DEACTIVATED) {
            return res('', 0, 'لقد تم تعطيل حسابك');
        }

        if ($user->status == User::STATUS_BLOCKED) {
            return res('', 0, 'لقد تم حظر حسابك');
        }

        $user->save();
        $FirebaseToken = FirebaseToken::where('token', $request->firebase_token)->first();

        if ($FirebaseToken != null) {
            $FirebaseToken->delete();
        }
        $user->firebase_tokens()->create(['token' => $request->firebase_token]);
        
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];


        return res($data, 1, 'تم تسجيل الدخول بنجاح');
    }

    public function logout(Request $request) {
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        return res('', 1, 'تم تسجيل الخروج');
    }


    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('representatives')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? res('', 1, 'تم ارسال بريد استعادة كلمة السر بنجاح') : res('', 1, ['email' => __($status)]);

    }

    public function reset_password_token($token)
    {
        return view('app.auth.passwords.reset', ['token' => $token]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
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
