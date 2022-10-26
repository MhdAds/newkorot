<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;


class DistributorsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|distributors-list'])->only(['index']);
        $this->middleware(['permission:super|distributors-show'])->only(['show']);
        $this->middleware(['permission:super|distributors-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|distributors-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|distributors-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $distributors = User::where('account_type', 'distributor')->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.distributors.index', ['distributors' => $distributors]);
    }

    public function find(Request $r)
    {

        $distributors = User::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.distributors.index', ['distributors' => $distributors, 'text' => $r->text]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_staff = Staff::all();
        return view('dashboard.distributors.create', compact('all_staff'));
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
        
        $Distributor = new User;
        $Distributor->supervisor_id = $r->supervisor_id;
        $Distributor->name = $r->name;
        $Distributor->email = $r->email;
        $Distributor->phone = $r->phone;
        $Distributor->password = Hash::make($r->password);
        $Distributor->save();

        if($r->hasFile('avatar')) {
            save_images($Distributor, $r->avatar, 'avatar');
        }
       

        return redirect()->route('dashboard.distributors.index')->with('success', 'User added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Distributor = User::findOrfail($id);
        // $governorates = Governorate::all();
        // $cities = City::all();
        $all_staff = Staff::all();

        return view('dashboard.distributors.show', compact([
            'Distributor',
            // 'governorates',
            // 'cities',
            'all_staff',
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
        $Distributor = User::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $all_staff = Staff::all();

        return view('dashboard.distributors.edit', compact([
            'Distributor',
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

        $Distributor = User::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users,phone,' .$id],

        ]);

        $Distributor = User::findOrfail($id);

        if ($r->supervisor_id != null) {
            $Distributor->supervisor_id = $r->supervisor_id;
        }

        if ( $r->name != null) {
            $Distributor->name = $r->name;
        }

        if ( $r->email != null) {
            $Distributor->email = $r->email;
        }

        if ( $r->phone != null) {
            $Distributor->phone = $r->phone;
        }

        if ( $r->status != null) {
            $Distributor->status = $r->status;
        }
        
        if ($r->password != null) {
            $Distributor->password = Hash::make($r->password);
        }
        $Distributor->save();

        if($r->hasFile('avatar')) {
            if (is_file('public/settings' . '/' . $Distributor->avatar())) {
                Storage::delete('public/settings' . '/' . $Distributor->avatar());
            }
            save_images($Distributor, $r->avatar, 'avatar');
        }

        return redirect()->route('dashboard.distributors.index')->with('success', 'User data has been modified successfully');
    }

    public function update_info(Request $r, $id)
    {

        $Distributor = User::findOrfail($id);
        $r->validate([

        ]);

        $Distributor = User::findOrfail($id);
        $Distributor->gender = $r->gender;
        $Distributor->birth_date = $r->birth_date;
        $Distributor->address_line_1 = $r->address_line_1;
        $Distributor->address_line_1 = $r->address_line_1;
        $Distributor->address_line_2 = $r->address_line_2;
        $Distributor->governorate_id = $r->governorate_id;
        $Distributor->city_id = $r->city_id;
        $Distributor->save();


        return redirect()->route('dashboard.distributors.index')->with('success', 'User data has been modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Distributor = User::findOrfail($id);
        if (is_file('public/distributors/avatar' . '/' . $Distributor->avatar())) {
            Storage::delete('public/distributors/avatar' . '/' . $Distributor->avatar());
        }
        $Distributor->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }




}
