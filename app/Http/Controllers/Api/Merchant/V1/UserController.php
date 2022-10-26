<?php

namespace App\Http\Controllers\Api\Merchant\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    

    public function data_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . request()->user()->id,
            'address' => 'required',
            'current_password' => 'required|string',

        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $User = User::findOrfail($request->user()->id);
        if (Hash::check($request->current_password, $User->password)) {
            // $User->name = $request->name;
            $User->email = $request->email;
            $User->address_line_1 = $request->address;


            $User->save();
        
            if($request->hasFile('avatar')) {
                save_images($User, $request->avatar, 'avatar');
            }
            $User = User::findOrfail($request->user()->id);
            return res($User, 1, 'تم تغير البيانات بنجاح');
        }
        return res($User, 0, 'كلمة السر الحالية غير صحيحة');
        
    }

        
    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
            'current_password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $User = User::findOrfail($request->user()->id);

        if(Hash::check($request->current_password, $User->password)){
            $User->password = Hash::make($request->password);
            $User->save();
            // Auth::logoutOtherDevices($currentPassword);

            return res(null, 1, 'تم تغير كلمة السر بنجاح');
        }
        return res(null, 0, 'كلمة السر الحالية غير صحيحة');
    }


    
}
