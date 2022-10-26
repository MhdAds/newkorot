<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserVisit;
use App\Models\PlanVisit;
use App\Models\CancelReason;
use Carbon\Carbon;

class VisitsController extends Controller
{

    public function cancel_reasons(Request $request)
    {
        $reasons = CancelReason::all();
        return res($reasons, 1, '');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'plan_visit_id' => 'required',
            'status' => 'required',
            'type' => 'required',
            'visit_time' => 'required',
            // 'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $PlanVisit = PlanVisit::find($request->plan_visit_id);

        if ($PlanVisit == null) {
            return res('', 0, ['error' => 'الزيارة غير موجودة']);
        }

        if ($PlanVisit->visits <= $PlanVisit->user_visits()->where('status', UserVisit::STATUS_COMPLETED)->count()) {
            return res('', 0, ['visits_count' => 'الزيارات مكتملة لا يمكن اضافة زيارة جديدة']);
        }


        // $start_date = $request->visit_time;
        // $end_date = Carbon::now();
        // $different_days = $start_date->diffInDays($end_date);
        
        // if ($different_days > 2) {
        //     return res('', 0, ['visit_date' => 'لا يمكن اضافة زيارة مرة عليها اكثر من يومين']);
        // }

        $PlanVisit = PlanVisit::find($request->plan_visit_id);
        

        $UserVisit = new UserVisit;
        $UserVisit->user_id = $request->user()->id;

        $UserVisit->specialty_id = $PlanVisit->clinic->doctor->specialty->id;
        $UserVisit->doctor_id = $PlanVisit->clinic->doctor->id;
        $UserVisit->clinic_id = $PlanVisit->clinic->id;

        $UserVisit->plan_visit_id = $request->plan_visit_id;

        $UserVisit->status = $request->status;
        $UserVisit->type = $request->type;
        $UserVisit->visit_time = $request->visit_time;
        $UserVisit->notes = $request->notes;

        if ($request->status == \App\Models\UserVisit::STATUS_CANCELLED) {
            $validator = Validator::make($request->all(), [
                'cancel_reason_id' => 'required',
            ]);
            if ($validator->fails()) {
                return res(null, 0, $validator->errors());
            }
            $UserVisit->cancel_reason_id = $request->cancel_reason_id;
        }


        $UserVisit->save();

        
        if ($request->status == \App\Models\UserVisit::STATUS_COMPLETED) {
            $validator = Validator::make($request->all(), [
                'main_products' => 'required',
                // 'secondary_products' => 'required',
            ]);
            foreach ($request->main_products as $mproduct) {
                $UserVisit->products()->syncWithoutDetaching([['product_id' => $mproduct, 'type' => 1]]);
            }
    
            if (isset($request->secondary_products) && is_array($request->secondary_products)) {
                foreach ($request->secondary_products as $sproduct) {
                    $UserVisit->products()->syncWithoutDetaching([['product_id' => $sproduct, 'type' => 0]]);
                }
            }

            

            if (isset($request->items) && is_array($request->items)) {
                foreach ($request->items as $item) {
                    $UserVisit->items()->syncWithoutDetaching([['item_id' => $item['id'], 'quantity' => $item['quantity']]]);
                }
            }
            
            // $UserVisit->items()->sync($request->items);
    
        }

        $UserVisit->main_products;
        $UserVisit->secondary_products;
        $UserVisit->items;

        

        return res($UserVisit, 1, '');
    }


    
}
