<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|reports-list']);
    }

    private function array_count_if_null($arr) {
        if (is_array($arr) && sizeof($arr) > 0 && !empty($arr)) {
            return sizeof($arr);
        }
        return 0;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       
        return view('dashboard.reports.index', [
            

        ]);
    }

    public function items_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',

        ]);
        $visits_ids = UserVisit::whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->pluck('id')->toArray();

        $items = Item::all();
        $items_use = DB::table('user_visit_items')
        ->whereIn('user_visit_id', $visits_ids)
        ->get();

        $report = [['Product id', 'Product name', 'Quantity']];
        foreach ($items as $item) {
            array_push($report, [
                $item->id, 
                $item->name, 
                $items_use->where('item_id', $item->id)->sum('quantity')
            ]);
        }
        return Excel::download(new ItemsReportExport($report), 'Items report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }


    public function products_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',

        ]);

        $visits_ids = UserVisit::whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->pluck('id')->toArray();

        $products = Product::all();
        $products_use = DB::table('user_visit_products')
        ->whereIn('user_visit_id', $visits_ids)
        ->get();
        
        $report = [['Product id', 'Product name', 'All visits', 'Visits as main', 'Visits as secondary']];
        foreach ($products as $product) {
            array_push($report, [
                $product->id, 
                $product->name, 
                $products_use->where('product_id', $product->id)->count(),
                $products_use->where('product_id', $product->id)->where('type', 1)->count(),
                $products_use->where('product_id', $product->id)->where('type', 0)->count(),

            ]);
        }
        return Excel::download(new ProductsReportExport($report), 'Products report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

    public function specialties_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',

        ]);

        $visits = UserVisit::whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->get();

        $specialties = Specialty::all();

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $period_plans = Plan::whereBetween('month',[$from,$to])->pluck('id')->toArray();
        
        $report = [['Specialty id', 'Specialty name', 'Target visits', 'All visits', 'All completed visits', 'All cancelled visits', '%']];
        foreach ($specialties as $specialty) {
            $doctors = Doctor::where('specialty_id', $specialty->id)->pluck('id');
            $specialty_doctors_target_visits = PlanVisit::whereIn('doctor_id', $doctors)->whereIn('plan_id',$period_plans)->sum('visits');
            array_push($report, [
                $specialty->id, 
                $specialty->name, 
                $specialty_doctors_target_visits,
                $visits->where('specialty_id', $specialty->id)->count(),
                $visits->where('specialty_id', $specialty->id)->where('status', 1)->count(),
                $visits->where('specialty_id', $specialty->id)->where('status', 0)->count(),
                ($specialty_doctors_target_visits > 0) ? $visits->where('specialty_id', $specialty->id)->where('status', 1)->count()/$specialty_doctors_target_visits : 'غير محدد',
            ]);
        }
        return Excel::download(new SpecialtysReportExport($report), 'Specialties report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

    

    public function representatives_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',

        ]);

        $visits = UserVisit::whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->get();

        $users = User::all();
        
        $report = [['Representative id', 'Representative name', 'All visits', 'All completed visits', 'All cancelled visits']];
        foreach ($users as $user) {
            array_push($report, [
                $user->id, 
                $user->name, 
                $visits->where('user_id', $user->id)->count(),
                $visits->where('user_id', $user->id)->where('status', 1)->count(),
                $visits->where('user_id', $user->id)->where('status', 0)->count(),

            ]);
        }
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

    public function representative_report(Request $request)
    {
        $request->validate([
            'representative_id' => 'required',
            'from' => 'required',
            'to' => 'required',

        ]);

        $visits = UserVisit::with('main_products')->where('user_id', $request->representative_id)->whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->get();

        $users = User::all();
        
        $report = [['Doctor name', 'Visit Time', 'Main Products', 'Secondary Products', 'Items', 'Status', 'Type', 'Notes']];
        foreach ($visits as $visit) {

            $main_products = '';
            $secondary_products = '';
            $items = '';

           
            foreach ($visit->main_products as $product) {
                $main_products = $main_products . ' - ' . $product->name;
            }

            foreach ($visit->secondary_products as $product) {
                $secondary_products = $secondary_products . ' - ' . $product->name;
            }

            foreach ($visit->items as $item) {
                $items = $items . ' - ' . $item->name;
            }

            array_push($report, [
                $visit->doctor->name, 
                $visit->visit_time,
                $main_products,
                $secondary_products,
                $items,
                ($visit->status == UserVisit::STATUS_CANCELLED) ? 'ملغية' : 'مكتملة', 
                ($visit->type == UserVisit::TYPE_INDIVIDUAL) ? 'فردي' : 'مع المشرف', 
                $visit->notes, 
            ]);
        }
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }


    public function representative_general_report(Request $request)
    {
        $request->validate([
            'representative_id' => 'required',
            'month' => 'required',
        ]);

        
        $date = Carbon::parse($request->month);
        $plan = Plan::where('user_id', $request->representative_id)
        ->where('year', $date->year)
        ->where('month', $request->month)
        ->first();

        if ($plan == null) {
            return redirect()->back()->with('error', 'No plan for this month');
        }
        $PlanVisits = PlanVisit::where('plan_id', $plan->id)->pluck('doctor_id')->toArray();
        $PlanVisitsIds = PlanVisit::where('plan_id', $plan->id)->pluck('id')->toArray();

        $doctors_ids = array_unique($PlanVisits);
        $visits_doctors_ids = UserVisit::whereIn('plan_visit_id', $PlanVisitsIds)->pluck('doctor_id')->toArray();
        $visits_doctors_ids = array_unique($visits_doctors_ids);
        $report = [['Item', 'Plan', 'Actual', '%']];
        array_push($report, [
            'Coverage',
            count($doctors_ids),
            count($visits_doctors_ids),
            (count($doctors_ids) > 0) ? count($visits_doctors_ids)/count($doctors_ids)*100 : 'غير محسوب',
        ]);
        

        $class_a_doctors = Doctor::where('doctor_category_id', 1)->pluck('id')->toArray();
        $class_a_plan_visits = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_a_doctors)->sum('visits');
        $class_a_plan_visits_ids = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_a_doctors)->pluck('id')->toArray();
        $class_a_doctors_visit = UserVisit::whereIn('plan_visit_id', $class_a_plan_visits_ids)->whereIn('doctor_id', $class_a_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();
        array_push($report, [
            'Class (A) Freq',
            $class_a_plan_visits,
            $class_a_doctors_visit,
            ($class_a_plan_visits > 0) ? $class_a_doctors_visit/$class_a_plan_visits *100 : 'غير محسوب',
        ]);


        $class_b_doctors = Doctor::where('doctor_category_id', 2)->pluck('id')->toArray();
        $class_b_plan_visits = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_b_doctors)->sum('visits');
        $class_b_plan_visits_ids = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_b_doctors)->pluck('id')->toArray();

        $class_b_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_b_plan_visits_ids)->whereIn('doctor_id', $class_b_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (B) Freq',
            $class_b_plan_visits,
            $class_b_doctors_visits,
            ($class_b_plan_visits > 0) ? $class_b_doctors_visits/$class_b_plan_visits*100 : 'غير محسوب',
        ]);


        $class_c_doctors = Doctor::where('doctor_category_id', 3)->pluck('id')->toArray();
        $class_c_plan_visits = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_c_doctors)->sum('visits');
        $class_c_plan_visits_ids = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $class_c_doctors)->pluck('id')->toArray();
        $class_c_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_c_plan_visits_ids)->whereIn('doctor_id', $class_c_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (C) Freq',
            $class_c_plan_visits,
            $class_c_doctors_visits,
            ($class_c_plan_visits > 0) ? $class_c_doctors_visits/$class_c_plan_visits*100 : 'غير محسوب',
        ]);


        $FrequencyPlanVisits = PlanVisit::where('plan_id', $plan->id)->sum('visits');
        $FrequencyPlanVisits_ids = PlanVisit::where('plan_id', $plan->id)->pluck('id')->toArray();

        $FrequencyUserVisit = UserVisit::whereIn('plan_visit_id', $FrequencyPlanVisits_ids)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Frequency',
            $FrequencyPlanVisits,
            $FrequencyUserVisit,
            ($FrequencyPlanVisits > 0) ? number_format($FrequencyUserVisit/$FrequencyPlanVisits*100, 2, '.', ' ') : 'غير محسوب',
        ]);

        array_push($report, ['','','','','']);
        array_push($report, ['Item', 'Plan', 'Actual', '%']);

        $specialties = Specialty::all();
        $doctors_ids;
        $plan;

        foreach ($specialties as $specialty) {
            $specialty_doctors = Doctor::whereIn('id', $doctors_ids)->where('specialty_id', $specialty->id)->pluck('id')->toArray();
            $specialtyPlanVisits = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $specialty_doctors)->sum('visits');
            $specialtyPlanVisits_ids = PlanVisit::where('plan_id', $plan->id)->whereIn('doctor_id', $specialty_doctors)->pluck('id')->toArray();

            $specialtyUserVisit = UserVisit::whereIn('plan_visit_id', $specialtyPlanVisits_ids)->whereIn('doctor_id', $specialty_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

            array_push($report, [
                $specialty->name,
                $specialtyPlanVisits,
                $specialtyUserVisit,
                ($specialtyPlanVisits > 0) ? $specialtyUserVisit/$specialtyPlanVisits * 100 : 'غير محسوب',
            ]);
        }

        array_push($report, ['','','','','']);
        array_push($report, ['Doctor name','Specialty','Class','Planned Visits/Month','Done', 'Done/Planned %']);
        $plan->visits;

        foreach ($plan->visits as $visit) {
            $visits_done = UserVisit::where('plan_visit_id', $visit->id)->where('status', UserVisit::STATUS_COMPLETED)->count();
       
            array_push($report, [
                $visit->doctor->name,
                $visit->doctor->specialty->name,
                $visit->doctor->category->name,
                $visit->visits,
                $visits_done,
                ($visit->visits > 0) ? $visits_done / $visit->visits *100 : 'غير محسوبة' 
            ]);
        }
        
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }


    public function representative_city_report(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'month' => 'required',
        ]);

        $city_doctors = Doctor::where('city_id', $request->city_id)->pluck('id')->toArray();
        
        $date = Carbon::parse($request->month);
        $plans = Plan::where('year', $date->year)
        ->where('month', $request->month)
        ->pluck('id')->toArray();

        $PlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $city_doctors)->pluck('doctor_id')->toArray();
        $PlanVisitsIds = PlanVisit::whereIn('plan_id', $plans)->pluck('id')->toArray();

        $doctors_ids = array_unique($PlanVisits);
        $visits_doctors_ids = UserVisit::whereIn('plan_visit_id', $PlanVisitsIds)->whereIn('doctor_id', $city_doctors)->pluck('doctor_id')->toArray();
        $visits_doctors_ids = array_unique($visits_doctors_ids);
        $report = [['Item', 'Plan', 'Actual', '%']];
        array_push($report, [
            'Coverage',
            count($doctors_ids),
            count($visits_doctors_ids),
            (count($doctors_ids) > 0) ? count($visits_doctors_ids)/count($doctors_ids)*100 : 'غير محسوب',
        ]);
        

        $class_a_doctors = Doctor::where('doctor_category_id', 1)->whereIn('id', $city_doctors)->pluck('id')->toArray();
        $class_a_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_a_doctors)->sum('visits');
        $class_a_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_a_doctors)->pluck('id')->toArray();
        $class_a_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_a_plan_visits_ids)->whereIn('doctor_id', $class_a_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();
        
        array_push($report, [
            'Class (A) Freq',
            $class_a_plan_visits,
            $class_a_doctors_visits,
            ($class_a_plan_visits > 0) ? $class_a_doctors_visits/$class_a_plan_visits *100 : 'غير محسوب',
        ]);


        $class_b_doctors = Doctor::where('doctor_category_id', 2)->whereIn('id', $city_doctors)->pluck('id')->toArray();
        $class_b_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_b_doctors)->sum('visits');
        $class_b_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_b_doctors)->pluck('id')->toArray();

        $class_b_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_b_plan_visits_ids)->whereIn('doctor_id', $class_b_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (B) Freq',
            $class_b_plan_visits,
            $class_b_doctors_visits,
            ($class_b_plan_visits > 0) ? $class_b_doctors_visits/$class_b_plan_visits*100 : 'غير محسوب',
        ]);


        $class_c_doctors = Doctor::where('doctor_category_id', 3)->whereIn('id', $city_doctors)->pluck('id')->toArray();
        $class_c_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_c_doctors)->sum('visits');
        $class_c_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_c_doctors)->pluck('id')->toArray();
        $class_c_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_c_plan_visits_ids)->whereIn('doctor_id', $class_c_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (C) Freq',
            $class_c_plan_visits,
            $class_c_doctors_visits,
            ($class_c_plan_visits > 0) ? $class_c_doctors_visits/$class_c_plan_visits*100 : 'غير محسوب',
        ]);


        $FrequencyPlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $city_doctors)->sum('visits');
        $FrequencyPlanVisits_ids = PlanVisit::whereIn('plan_id', $plans)->pluck('id')->toArray();

        $FrequencyUserVisit = UserVisit::whereIn('plan_visit_id', $FrequencyPlanVisits_ids)->whereIn('doctor_id', $city_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Frequency',
            $FrequencyPlanVisits,
            $FrequencyUserVisit,
            ($FrequencyPlanVisits > 0) ? number_format($FrequencyUserVisit/$FrequencyPlanVisits*100, 2, '.', ' ') : 'غير محسوب',
        ]);

        array_push($report, ['','','','','']);
        array_push($report, ['Item', 'Plan', 'Actual', '%']);

        $specialties = Specialty::all();
        $doctors_ids;

        foreach ($specialties as $specialty) {
            $specialty_doctors = Doctor::whereIn('id', $doctors_ids)->where('specialty_id', $specialty->id)->whereIn('id', $city_doctors)->pluck('id')->toArray();
            $specialtyPlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $specialty_doctors)->sum('visits');
            $specialtyPlanVisits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $specialty_doctors)->pluck('id')->toArray();

            $specialtyUserVisit = UserVisit::whereIn('plan_visit_id', $specialtyPlanVisits_ids)->whereIn('doctor_id', $specialty_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

            array_push($report, [
                $specialty->name,
                $specialtyPlanVisits,
                $specialtyUserVisit,
                ($specialtyPlanVisits > 0) ? $specialtyUserVisit/$specialtyPlanVisits * 100 : 'غير محسوب',
            ]);
        }

        array_push($report, ['','','','','']);
        array_push($report, ['Doctor name','Specialty','Class','Planned Visits/Month','Done', 'Done/Planned %']);
        $visits = PlanVisit::whereIn('plan_id',$plans)->whereIn('doctor_id', $city_doctors)->get();

        foreach ($visits as $visit) {
            $visits_done = UserVisit::where('plan_visit_id', $visit->id)->where('status', UserVisit::STATUS_COMPLETED)->count();
       
            array_push($report, [
                $visit->doctor->name,
                $visit->doctor->specialty->name,
                $visit->doctor->category->name,
                $visit->visits,
                $visits_done,
                ($visit->visits > 0) ? $visits_done / $visit->visits *100 : 'غير محسوبة' 
            ]);
        }
        
        
        
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

    public function representative_governorate_report(Request $request)
    {
        $request->validate([
            'governorate_id' => 'required',
            'month' => 'required',
        ]);

        $governorate_doctors = Doctor::where('governorate_id', $request->governorate_id)->pluck('id')->toArray();
        
        $date = Carbon::parse($request->month);
        $plans = Plan::where('year', $date->year)
        ->where('month', $request->month)
        ->pluck('id')->toArray();

        $PlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $governorate_doctors)->pluck('doctor_id')->toArray();
        $PlanVisitsIds = PlanVisit::whereIn('plan_id', $plans)->pluck('id')->toArray();

        $doctors_ids = array_unique($PlanVisits);
        $visits_doctors_ids = UserVisit::whereIn('plan_visit_id', $PlanVisitsIds)->whereIn('doctor_id', $governorate_doctors)->pluck('doctor_id')->toArray();
        $visits_doctors_ids = array_unique($visits_doctors_ids);
        $report = [['Item', 'Plan', 'Actual', '%']];
        array_push($report, [
            'Coverage',
            count($doctors_ids),
            count($visits_doctors_ids),
            (count($doctors_ids) > 0) ? count($visits_doctors_ids)/count($doctors_ids)*100 : 'غير محسوب',
        ]);
        

        $class_a_doctors = Doctor::where('doctor_category_id', 1)->whereIn('id', $governorate_doctors)->pluck('id')->toArray();
        $class_a_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_a_doctors)->sum('visits');
        $class_a_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_a_doctors)->pluck('id')->toArray();
        $class_a_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_a_plan_visits_ids)->whereIn('doctor_id', $class_a_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();
        
        array_push($report, [
            'Class (A) Freq',
            $class_a_plan_visits,
            $class_a_doctors_visits,
            ($class_a_plan_visits > 0) ? $class_a_doctors_visits/$class_a_plan_visits *100 : 'غير محسوب',
        ]);


        $class_b_doctors = Doctor::where('doctor_category_id', 2)->whereIn('id', $governorate_doctors)->pluck('id')->toArray();
        $class_b_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_b_doctors)->sum('visits');
        $class_b_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_b_doctors)->pluck('id')->toArray();
        $class_b_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_b_plan_visits_ids)->whereIn('doctor_id', $class_b_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (B) Freq',
            $class_b_plan_visits,
            $class_b_doctors_visits,
            ($class_b_plan_visits > 0) ? $class_b_doctors_visits/$class_b_plan_visits*100 : 'غير محسوب',
        ]);


        $class_c_doctors = Doctor::where('doctor_category_id', 3)->whereIn('id', $governorate_doctors)->pluck('id')->toArray();
        $class_c_plan_visits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_c_doctors)->sum('visits');
        $class_c_plan_visits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $class_c_doctors)->pluck('id')->toArray();
        $class_c_doctors_visits = UserVisit::whereIn('plan_visit_id', $class_c_plan_visits_ids)->whereIn('doctor_id', $class_c_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Class (C) Freq',
            $class_c_plan_visits,
            $class_c_doctors_visits,
            ($class_c_plan_visits > 0) ? $class_c_doctors_visits/$class_c_plan_visits*100 : 'غير محسوب',
        ]);


        $FrequencyPlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $governorate_doctors)->sum('visits');
        $FrequencyPlanVisits_ids = PlanVisit::whereIn('plan_id', $plans)->pluck('id')->toArray();

        $FrequencyUserVisit = UserVisit::whereIn('plan_visit_id', $FrequencyPlanVisits_ids)->whereIn('doctor_id', $governorate_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

        array_push($report, [
            'Frequency',
            $FrequencyPlanVisits,
            $FrequencyUserVisit,
            ($FrequencyPlanVisits > 0) ? number_format($FrequencyUserVisit/$FrequencyPlanVisits*100, 2, '.', ' ') : 'غير محسوب',
        ]);

        array_push($report, ['','','','','']);
        array_push($report, ['Item', 'Plan', 'Actual', '%']);

        $specialties = Specialty::all();
        $doctors_ids;

        foreach ($specialties as $specialty) {
            $specialty_doctors = Doctor::whereIn('id', $doctors_ids)->where('specialty_id', $specialty->id)->whereIn('id', $governorate_doctors)->pluck('id')->toArray();
            $specialtyPlanVisits = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $specialty_doctors)->sum('visits');
            $specialtyPlanVisits_ids = PlanVisit::whereIn('plan_id', $plans)->whereIn('doctor_id', $specialty_doctors)->pluck('id')->toArray();

            $specialtyUserVisit = UserVisit::whereIn('plan_visit_id', $specialtyPlanVisits_ids)->whereIn('doctor_id', $specialty_doctors)->where('status', UserVisit::STATUS_COMPLETED)->count();

            array_push($report, [
                $specialty->name,
                $specialtyPlanVisits,
                $specialtyUserVisit,
                ($specialtyPlanVisits > 0) ? $specialtyUserVisit/$specialtyPlanVisits * 100 : 'غير محسوب',
            ]);
        }

        array_push($report, ['','','','','']);
        array_push($report, ['Doctor name','Specialty','Class','Planned Visits/Month','Done', 'Done/Planned %']);
        $visits = PlanVisit::whereIn('plan_id',$plans)->whereIn('doctor_id', $governorate_doctors)->get();

        foreach ($visits as $visit) {
            $visits_done = UserVisit::where('plan_visit_id', $visit->id)->where('status', UserVisit::STATUS_COMPLETED)->count();
       
            array_push($report, [
                $visit->doctor->name,
                $visit->doctor->specialty->name,
                $visit->doctor->category->name,
                $visit->visits,
                $visits_done,
                ($visit->visits > 0) ? $visits_done / $visit->visits *100 : 'غير محسوبة' 
            ]);
        }
        
        
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

    public function representative_visits_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'representative_id' => 'required',
        ]);

        $visits = UserVisit::where('user_id', $request->representative_id)->whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->get();

        $user = User::find($request->representative_id);
        $report = [['Representative id', 'Representative name', 'All visits', 'All completed visits', 'All cancelled visits']];
        array_push($report, [
            $user->id, 
            $user->name, 
            $visits->count(),
            $visits->where('status', 1)->count(),
            $visits->where('status', 0)->count(),

        ]);
        return Excel::download(new RepresentativesReportExport($report), 'Representatives report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }


    public function doctors_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',

        ]);

        $visits = UserVisit::whereDate('created_at','>=', $request->from)
        ->whereDate('created_at','<=', $request->to)
        ->get();
        $doctors = Doctor::all();
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        $period_plans = Plan::whereBetween('month',[$from,$to])->pluck('id')->toArray();
        
        

        $report = [['Doctor id', 'Doctor name', 'Target visits', 'All visits', 'All completed visits', 'All cancelled visits', '%']];
        foreach ($doctors as $doctor) {
            $doctor_target_visits = PlanVisit::where('doctor_id', $doctor->id)->whereIn('plan_id',$period_plans)->sum('visits');
            array_push($report, [
                $doctor->id, 
                $doctor->name, 
                $doctor_target_visits,
                $visits->where('doctor_id', $doctor->id)->count(),
                $visits->where('doctor_id', $doctor->id)->where('status', 1)->count(),
                $visits->where('doctor_id', $doctor->id)->where('status', 0)->count(),
                ($doctor_target_visits > 0) ? $visits->where('doctor_id', $doctor->id)->where('status', 0)->count()/$doctor_target_visits : 'غير محدد',
            ]);
        }
        return Excel::download(new DoctorsReportExport($report), 'Doctors report from ' . $request->from . ' to ' .$request->from . '.xlsx');
    }

}
