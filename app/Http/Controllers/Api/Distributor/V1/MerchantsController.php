<?php

namespace App\Http\Controllers\Api\Distributor\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;
use App\Models\PlanVisit;
use App\Models\UserVisit;
use Carbon\Carbon;

class MerchantsController extends Controller
{
    
    public function distributor_merchants(Request $request)
    {
        $merchants = User::where('account_type', 'merchant')->where('distributor_id', request()->user()->id)->paginate(20);
        return res($merchants, 1, '');
    }

    public function merchant_profile($id)
    {
        $merchants = User::find();
        return res($merchants, 1, '');
    }

}
