<?php

namespace App\Http\Controllers\Api\Merchant\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordCode;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasswordController extends Controller
{
    
    public function forgot_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $User = User::where('email', $request->email)->first();

        if ($User == null) {
            return res(null, 0, 'البريد الالكتروني غير موجود');
        } 

        $user_last_codes_count = DB::table('password_reset_codes')
        ->where('email', $request->email)
        ->where('created_at', '>=', \Carbon\Carbon::now()->subHour())
        ->count();
        
        if ($user_last_codes_count >= 5) {
            return res('', 2, 'لقد تخطيت الحد المسموح به من المحاولات يرجى المحاولة لاحقاً');
        }

        $code = rand(100000, 999999);
        DB::table('password_reset_codes')->insert([
            'email' => $request->email,
            'code' => $code,
            'created_at' => date("Y-m-d H:i:s", strtotime('now'))

        ]);

        Mail::to($request->user())->send(new ResetPasswordCode($code));
        return res(null, 1, 'تم ارسال كود ستعادة كلمة السر');
    }


    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }
    
        $User = User::where('email', $request->email)->first();

        if ($User == null) {
            return res(null, 0, 'البريد الالكتروني غير موجود');
        } 
        
        $user_last_code = DB::table('password_reset_codes')
        ->where('email', $request->email)
        ->orderBy('created_at', 'desc')
        ->first();

        

        if ($user_last_code->code != $request->code) {
            if ($user_last_code->try >= 3) {
                return res('', 2, 'لقد تخطيت الحد المسموح به من المحاولات');
            }

            $user_last_code = DB::table('password_reset_codes')
            ->where('id', $user_last_code->id)
            ->update(['try' => $user_last_code->try + 1]);
            return res('', 0, 'الكود غير صحيح');
        }

        

        

        $new_password = Hash::make($request->password);
        $User->password = $new_password;
        $User->save();

        $token = $User->createToken('auth_token')->plainTextToken;
        
        $data = [
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];
        return res($data, 1, 'تم تغير كلمة السر بنجاح');
    }
}
