<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;
use App\Models\PlanVisit;
use App\Models\UserVisit;
use App\Models\CancelReason;

class PlansController extends Controller
{


    public function years(Request $request)
    {
        $years = Plan::where('user_id', $request->user()->id)->orderBy('year', 'asc')->distinct()->pluck('year');
        $years_with_data = [];
        foreach ($years as $year) {
            $plans = Plan::where('user_id', $request->user()->id)->where('year', $year)->pluck('id');
            $year_all_visits = PlanVisit::whereIn('plan_id', $plans->toArray())->withCount(['completed_user_visits', 'cancelled_user_visits'])->get();
            array_push($years_with_data, [$year => [
                'all_visits' => $year_all_visits->sum('visits'),
                'completed_user_visits' => $year_all_visits->sum('completed_user_visits_count'),
                'cancelled_user_visits' => $year_all_visits->sum('cancelled_user_visits_count'),

            ]]);
        }
        return res($years_with_data, 1, '');
    }

    public function year_plans(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $plans = Plan::where('user_id', $request->user()->id)
        ->where('year', $request->year)
        ->orderBy('month', 'asc') 
        ->get();


        $plans_with_data = [];
        foreach ($plans as $plan) {
            $plan_all_visits = PlanVisit::where('plan_id', $plan->id )->withCount(['completed_user_visits', 'cancelled_user_visits'])->get();
            array_push($plans_with_data, [$plan->month => [
                'plan_id' => $plan->id,
                'all_visits' => $plan_all_visits->sum('visits'),
                'completed_user_visits' => $plan_all_visits->sum('completed_user_visits_count'),
                'cancelled_user_visits' => $plan_all_visits->sum('cancelled_user_visits_count'),

            ]]);
        }

        return res($plans_with_data, 1, '');
    }

    public function plan_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        
        $Plan = Plan::where('id', $request->plan_id)->first();
        $user_visits_count = $Plan->visits->sum('visits');
        $user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        unset($Plan['visits']);
        unset($Plan['user_id']);
        unset($Plan['line_id']);
        unset($Plan['updated_at']);
        $Plan['user_visits_count'] = $user_visits_count;
        $Plan['user_completed_visits_count'] = $user_completed_visits_count;
        $Plan['user_cancelled_visits_count'] = $user_cancelled_visits_count;

        return res($Plan, 1, '');
    }

    public function plan_visits(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $visits = PlanVisit::where('plan_id', $request->plan_id)
        ->with(['clinic.doctor'])
        ->withCount(['completed_user_visits', 'cancelled_user_visits'])

        ->paginate(20);
        return res($visits, 1, '');
    }

    public function plan_visit_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_visit_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        
        $visit = PlanVisit::find($request->plan_visit_id);

        if ($visit == null) {
            return res(null, 0, ['error' => 'الزيارة غير متاحة']);
        }
        $visit->clinic->doctor;
        $user_completed_visits_count = UserVisit::where('plan_visit_id', $visit->id)->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $user_cancelled_visits_count = UserVisit::where('plan_visit_id', $visit->id)->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();
        $visit['user_completed_visits_count'] = $user_completed_visits_count;
        $visit['user_cancelled_visits_count'] = $user_cancelled_visits_count;
        $specialty = $visit->plan->line->specialties()->where('specialty_id', $visit->clinic->doctor->specialty_id)->get()->first();
        if ($specialty != null) {
            $visit['main_products'] = $specialty->main_products;
            $visit['secondary_products'] = $specialty->secondary_products;
            $visit['items'] = $specialty->items;

        } else {
            $visit['main_products'] = null;
            $visit['secondary_products'] = null;
            $visit['items'] = null;

        }
        


        return res([
            $visit
        ], 1, '');
    }

    public function user_visits(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        
        $Plan = Plan::where('id', $request->plan_id)->first();
        $user_visits_count = $Plan->visits->sum('visits');
        $user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        unset($Plan['visits']);
        unset($Plan['user_id']);
        unset($Plan['line_id']);
        unset($Plan['updated_at']);
        $Plan['user_visits_count'] = $user_visits_count;
        $Plan['user_completed_visits_count'] = $user_completed_visits_count;
        $Plan['user_cancelled_visits_count'] = $user_cancelled_visits_count;

        $visits = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->with(['plan_visit.clinic.doctor'])->paginate(20);
        return res([
            'plan' => $Plan,
            'visits' => $visits,

        ], 1, '');
    }

    public function user_visit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_visit_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $reasons = CancelReason::all();
        $visit = UserVisit::find($request->user_visit_id);
        if ($visit == null) {
            return res(null, 0, ['error' => 'الزيارة غير متاحة']);
        }
        $visit->main_products;
        $visit->secondary_products;
        $visit->items;

        if ($visit->status == 0) {
            $visit['cancel_reasons'] = $reasons;
        }
        return res($visit, 1, '');
    }

    public function plan_visit_user_visits(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_visit_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $visits = UserVisit::where('plan_visit_id', $request->plan_visit_id)->get();

        return res($visits, 1, '');
    }


    public function current_month_plan_visits(Request $request)
    {
        $Plan = Plan::where('user_id', $request->user()->id)
        ->where('month', date('Y-m'))
        ->first();

        if ($Plan == null) {
            return res(null, 0, ['error' => 'لا توجد خطة لهذل الشهر']);
        }


        $visits = PlanVisit::where('plan_id', $Plan->id)
        ->with(['clinic.doctor'])
        ->withCount(['completed_user_visits', 'cancelled_user_visits'])

        ->paginate(20);
        return res($visits, 1, '');
    }

    
    public function current_month_plan_user_visits(Request $request)
    {
        $Plan = Plan::where('user_id', $request->user()->id)
        ->where('month', date('Y-m'))
        ->first();
        if ($Plan == null) {
            return res(null, 0, ['error' => 'لا توجد خطة لهذل الشهر']);
        }
        $user_visits_count = $Plan->visits->sum('visits');
        $user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        unset($Plan['visits']);
        unset($Plan['user_id']);
        unset($Plan['line_id']);
        unset($Plan['updated_at']);
        $Plan['user_visits_count'] = $user_visits_count;
        $Plan['user_completed_visits_count'] = $user_completed_visits_count;
        $Plan['user_cancelled_visits_count'] = $user_cancelled_visits_count;

        $visits = UserVisit::whereIn('plan_visit_id', $Plan->visits()->pluck('id')->toArray())->with(['plan_visit.clinic.doctor'])->paginate(20);
        return res([
            'plan' => $Plan,
            'visits' => $visits,

        ], 1, '');
    }
    
}
