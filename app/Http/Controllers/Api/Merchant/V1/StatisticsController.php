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
    
    public function statistics(Request $request)
    {

        $user = User::find(request()->user()->id);

        $statistics = [
            'total_spending' => $user->total_spending,
            'total_sales' => $user->total_sales,
            'total_profits' => $user->total_profits,
            'total_collect' => $user->total_collect,
        ];

        return res($statistics, 1, '');
    }

}
