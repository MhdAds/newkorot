<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Staff;
use App\Models\Plan;
use App\Models\PlanVisit;
use App\Models\UserVisit;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Product;


class RepresentativesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|representatives-list'])->only(['index']);
        $this->middleware(['permission:super|representatives-show'])->only(['show']);
        $this->middleware(['permission:super|representatives-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|representatives-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|representatives-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $representatives = User::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.representatives.index', ['representatives' => $representatives]);
    }

    public function find(Request $r)
    {

        $Representatives = User::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.representatives.index', ['Representatives' => $Representatives, 'text' => $r->text]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_staff = Staff::all();
        return view('dashboard.representatives.create', compact('all_staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90','unique:users'],
            'phone' => ['required','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'supervisor_id' => ['required'],

        ]);
        
        $Representative = new User;
        $Representative->supervisor_id = $r->supervisor_id;
        $Representative->name = $r->name;
        $Representative->email = $r->email;
        $Representative->phone = $r->phone;
        $Representative->password = Hash::make($r->password);
        $Representative->save();

        if($r->hasFile('avatar')) {
            save_images($Representative, $r->avatar, 'avatar');
        }
       

        return redirect()->route('dashboard.representatives.index')->with('success', 'User added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Representative = User::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $all_staff = Staff::all();

        $all_plans = Plan::where('user_id', $Representative->id)->pluck('id')->toArray();
        $all_visits = PlanVisit::whereIn('plan_id', $all_plans)->get();
        $all_visits_count = $all_visits->sum('visits');
        $all_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $all_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $all_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $all_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        $year_plans = Plan::where('user_id', $Representative->id)->where('year', date('Y'))->pluck('id')->toArray();
        $year_visits = PlanVisit::whereIn('plan_id', $year_plans);
        $year_visits_count = $year_visits->sum('visits');
        $year_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $year_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $year_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $year_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();

        $month_plans = Plan::where('user_id', $Representative->id)->pluck('id')->toArray();
        $month_visits = PlanVisit::whereIn('plan_id', $month_plans);
        $month_visits_count = $month_visits->sum('visits');
        $month_user_completed_visits_count = UserVisit::whereIn('plan_visit_id', $month_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_COMPLETED)->count();
        $month_user_cancelled_visits_count = UserVisit::whereIn('plan_visit_id', $month_visits->pluck('id')->toArray())->where('status', \App\Models\UserVisit::STATUS_CANCELLED)->count();
       
        $visits_ids = UserVisit::where('user_id', $id)->pluck('id')->toArray();

        $items = Item::all();
        $user_items = DB::table('user_visit_items')
        ->whereIn('user_visit_id', $visits_ids)
        ->get();

        $products = Product::all();
        $user_products = DB::table('user_visit_products')
        ->whereIn('user_visit_id', $visits_ids)
        ->get();

        $uniqueDoctors = PlanVisit::whereIn('plan_id', $month_plans)->select('doctor_id')->distinct()->get()->count();
        $uniqueDoctorsVisits = UserVisit::where('user_id', $Representative->id)->select('doctor_id')->distinct()->get()->count();

// dd($uniqueDoctorsVisits);
        // $items->where('id', 1)->count();

        // dd($user_items);
        return view('dashboard.representatives.show', compact([
            'Representative',
            'governorates',
            'cities',
            'all_staff',

            'all_visits_count',
            'all_user_completed_visits_count',
            'all_user_cancelled_visits_count',

            'year_visits_count',
            'year_user_completed_visits_count',
            'year_user_cancelled_visits_count',

            'month_visits_count',
            'month_user_completed_visits_count',
            'month_user_cancelled_visits_count',
           
            'items',
            'user_items',

            'products',
            'user_products',

            'uniqueDoctors',
            'uniqueDoctorsVisits',


        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Representative = User::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $all_staff = Staff::all();

        return view('dashboard.representatives.edit', compact([
            'Representative',
            'governorates',
            'cities',
            'all_staff',

        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {

        $Representative = User::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users,phone,' .$id],

        ]);

        $Representative = User::findOrfail($id);

        if ($r->supervisor_id != null) {
            $Representative->supervisor_id = $r->supervisor_id;
        }

        if ( $r->name != null) {
            $Representative->name = $r->name;
        }

        if ( $r->email != null) {
            $Representative->email = $r->email;
        }

        if ( $r->phone != null) {
            $Representative->phone = $r->phone;
        }

        if ( $r->status != null) {
            $Representative->status = $r->status;
        }
        
        if ($r->password != null) {
            $Representative->password = Hash::make($r->password);
        }
        $Representative->save();

        if($r->hasFile('avatar')) {
            if (is_file('public/settings' . '/' . $Representative->avatar())) {
                Storage::delete('public/settings' . '/' . $Representative->avatar());
            }
            save_images($Representative, $r->avatar, 'avatar');
        }

        return redirect()->route('dashboard.representatives.index')->with('success', 'User data has been modified successfully');
    }

    public function update_info(Request $r, $id)
    {

        $Representative = User::findOrfail($id);
        $r->validate([

        ]);

        $Representative = User::findOrfail($id);
        $Representative->gender = $r->gender;
        $Representative->birth_date = $r->birth_date;
        $Representative->address_line_1 = $r->address_line_1;
        $Representative->address_line_1 = $r->address_line_1;
        $Representative->address_line_2 = $r->address_line_2;
        $Representative->governorate_id = $r->governorate_id;
        $Representative->city_id = $r->city_id;
        $Representative->save();


        return redirect()->route('dashboard.representatives.index')->with('success', 'User data has been modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Representative = User::findOrfail($id);
        if (is_file('public/representatives/avatar' . '/' . $Representative->avatar())) {
            Storage::delete('public/representatives/avatar' . '/' . $Representative->avatar());
        }
        $Representative->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }




}
