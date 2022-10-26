<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Governorate;
use App\Models\City;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|staff-list'])->only(['index']);
        $this->middleware(['permission:super|staff-show'])->only(['show']);
        $this->middleware(['permission:super|staff-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|staff-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|staff-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_staff = Staff::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.staff.index', ['all_staff' => $all_staff]);
    }

    public function find(Request $r)
    {

        $staff = Staff::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.staff.index', ['staff' => $staff, 'text' => $r->text]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions_groups = Permission::get()->groupBy('group');
        return view('dashboard.staff.create', compact(['roles', 'permissions_groups']));
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
            'email' => ['required', 'string', 'email', 'max:90','unique:staff'],
            'phone' => ['required','unique:staff'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required'],

        ]);
        
        $Staff = new Staff;
        $Staff->name = $r->name;
        $Staff->email = $r->email;
        $Staff->phone = $r->phone;
        $Staff->password = Hash::make($r->password);
        $Staff->save();
        $Staff->assignRole($r->role);
        if($r->hasFile('avatar')) {
            save_images($Staff, $r->avatar, 'avatar');
        }
       

        return redirect()->route('dashboard.staff.index')->with('success', 'Staff added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Staff = Staff::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $roles = Role::all();
        $permissions_groups = Permission::get()->groupBy('group');
        return view('dashboard.staff.show', compact([
            'Staff',
            'governorates',
            'cities',
            'roles',
            'permissions_groups',

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
        $Staff = Staff::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $roles = Role::all();
        $permissions_groups = Permission::get()->groupBy('group');
        return view('dashboard.staff.edit', compact([
            'Staff',
            'governorates',
            'cities',
            'roles',
            'permissions_groups',

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

        $Staff = Staff::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:staff,email,' .$id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'unique:staff,phone,' .$id],
            'role' => ['required'],

        ]);

        $Staff = Staff::findOrfail($id);
        $Staff->syncRoles([$r->role]);

        if ( $r->name != null) {
            $Staff->name = $r->name;
        }

        if ( $r->email != null) {
            $Staff->email = $r->email;
        }

        if ( $r->phone != null) {
            $Staff->phone = $r->phone;
        }

        if ( $r->status != null) {
            $Staff->status = $r->status;
        }
        
        if ($r->password != null) {
            $Staff->password = Hash::make($r->password);
        }
        $Staff->save();

        if($r->hasFile('avatar')) {
            if (is_file('public/settings' . '/' . $Staff->avatar())) {
                Storage::delete('public/settings' . '/' . $Staff->avatar());
            }
            save_images($Staff, $r->avatar, 'avatar');
        }

        return redirect()->route('dashboard.staff.index')->with('success', 'Staff data has been modified successfully');
    }

    public function update_info(Request $r, $id)
    {

        $Staff = Staff::findOrfail($id);
        $r->validate([

        ]);

        $Staff = Staff::findOrfail($id);
        $Staff->gender = $r->gender;
        $Staff->birth_date = $r->birth_date;
        $Staff->address_line_1 = $r->address_line_1;
        $Staff->address_line_1 = $r->address_line_1;
        $Staff->address_line_2 = $r->address_line_2;
        $Staff->governorate_id = $r->governorate_id;
        $Staff->city_id = $r->city_id;
        $Staff->save();


        return redirect()->route('dashboard.staff.index')->with('success', 'Staff data has been modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Staff = Staff::findOrfail($id);
        if (is_file('public/staff/avatar' . '/' . $Staff->avatar())) {
            Storage::delete('public/staff/avatar' . '/' . $Staff->avatar());
        }
        $Staff->delete();
        return redirect()->back()->with('success', 'Staff deleted successfully');
    }
}
