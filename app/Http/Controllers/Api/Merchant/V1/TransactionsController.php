<?php

namespace App\Http\Controllers\Api\Merchant\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;
use App\Models\PlanVisit;
use App\Models\UserVisit;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    
    public function transactions__history(Request $request)
    {
        $transactions = Transaction::where('user_id', request()->user()->id)->paginate(20);
        return res($transactions, 1, '');
    }

}
