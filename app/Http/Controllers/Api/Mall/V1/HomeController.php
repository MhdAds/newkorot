<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;
use App\Models\PlanVisit;
use App\Models\UserVisit;
use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function statistics(Request $request)
    {
      
        $all_plans = Plan::where('user_id', $request->user()->id)->pluck('id')->toArray();
        $all_visits = PlanVisit::whereIn('plan_id', $all_plans)->get();
        // $all_visits_count = $all_visits->sum('visits');
        $all_visits_count = UserVisit::whereIn('plan_visit_id', $all_visits->pluck('id')->toArray())->count();
        $all_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $all_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $all_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $all_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        $year_plans = Plan::where('user_id', $request->user()->id)->where('year', date('Y'))->pluck('id')->toArray();
        $year_visits = PlanVisit::whereIn('plan_id', $year_plans);
        // $year_visits_count = $year_visits->sum('visits');
        $year_visits_count = UserVisit::whereIn('plan_visit_id', $year_visits->pluck('id')->toArray())->whereYear('created_at', Carbon::now()->year)->count();
        $year_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $year_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->whereYear('created_at', Carbon::now()->year)->count();
        $year_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $year_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->whereYear('created_at', Carbon::now()->year)->count();

        $month_plans = Plan::where('user_id', $request->user()->id)->pluck('id')->toArray();
        $month_visits = PlanVisit::whereIn('plan_id', $month_plans);
        // $month_visits_count = $month_visits->sum('visits');
        $month_visits_count = UserVisit::whereIn('plan_visit_id', $month_visits->pluck('id')->toArray())->whereMonth('created_at', Carbon::now()->month)->count();
        $month_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $month_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->whereMonth('created_at', Carbon::now()->month)->count();
        $month_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $month_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->whereMonth('created_at', Carbon::now()->month)->count();
       
        
        $today_plans = Plan::where('user_id', $request->user()->id)->pluck('id')->toArray();
        $today_visits = PlanVisit::whereIn('plan_id', $today_plans);
        // $today_visits_count = $today_visits->sum('visits');
        $today_visits_count = UserVisit::whereIn('plan_visit_id', $today_visits->pluck('id')->toArray())->whereDate('created_at', Carbon::today())->count();
        $today_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $today_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->whereDate('created_at', Carbon::today())->count();
        $today_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $today_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->whereDate('created_at', Carbon::today())->count();


        return res([

            'all_visits_count' => $all_visits_count,
            'all_user_completed_visits_count' => $all_user_completed_visits_count,
            'all_user_cancelled_visits_count' => $all_user_cancelled_visits_count,

            'year_visits_count' => $year_visits_count,
            'year_user_completed_visits_count' => $year_user_completed_visits_count,
            'year_user_cancelled_visits_count' => $year_user_cancelled_visits_count,

            'month_visits_count' => $month_visits_count,
            'month_user_completed_visits_count' => $month_user_completed_visits_count,
            'month_user_cancelled_visits_count' => $month_user_cancelled_visits_count,

            'today_visits_count' => $today_visits_count,
            'today_user_completed_visits_count' => $today_user_completed_visits_count,
            'today_user_cancelled_visits_count' => $today_user_cancelled_visits_count,

        ], 1, '');
    }

}
