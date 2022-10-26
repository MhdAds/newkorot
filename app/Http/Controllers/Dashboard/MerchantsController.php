<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;


class MerchantsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|merchants-list'])->only(['index']);
        $this->middleware(['permission:super|merchants-show'])->only(['show']);
        $this->middleware(['permission:super|merchants-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|merchants-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|merchants-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $merchants = User::where('account_type', 'merchant')->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.merchants.index', ['merchants' => $merchants]);
    }

    public function find(Request $r)
    {

        $Merchants = User::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.merchants.index', ['Merchants' => $Merchants, 'text' => $r->text]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_staff = Staff::all();
        return view('dashboard.merchants.create', compact('all_staff'));
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
        
        $Merchant = new User;
        $Merchant->supervisor_id = $r->supervisor_id;
        $Merchant->name = $r->name;
        $Merchant->email = $r->email;
        $Merchant->phone = $r->phone;
        $Merchant->password = Hash::make($r->password);
        $Merchant->save();

        if($r->hasFile('avatar')) {
            save_images($Merchant, $r->avatar, 'avatar');
        }
       

        return redirect()->route('dashboard.merchants.index')->with('success', 'User added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Merchant = User::findOrfail($id);
        // $governorates = Governorate::all();
        // $cities = City::all();
        $all_staff = Staff::all();

        return view('dashboard.merchants.show', compact([
            'Merchant',
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
        $Merchant = User::findOrfail($id);
        $governorates = Governorate::all();
        $cities = City::all();
        $all_staff = Staff::all();

        return view('dashboard.merchants.edit', compact([
            'Merchant',
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

        $Merchant = User::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users,phone,' .$id],

        ]);

        $Merchant = User::findOrfail($id);

        if ($r->supervisor_id != null) {
            $Merchant->supervisor_id = $r->supervisor_id;
        }

        if ( $r->name != null) {
            $Merchant->name = $r->name;
        }

        if ( $r->email != null) {
            $Merchant->email = $r->email;
        }

        if ( $r->phone != null) {
            $Merchant->phone = $r->phone;
        }

        if ( $r->status != null) {
            $Merchant->status = $r->status;
        }
        
        if ($r->password != null) {
            $Merchant->password = Hash::make($r->password);
        }
        $Merchant->save();

        if($r->hasFile('avatar')) {
            if (is_file('public/settings' . '/' . $Merchant->avatar())) {
                Storage::delete('public/settings' . '/' . $Merchant->avatar());
            }
            save_images($Merchant, $r->avatar, 'avatar');
        }

        return redirect()->route('dashboard.merchants.index')->with('success', 'User data has been modified successfully');
    }

    public function update_info(Request $r, $id)
    {

        $Merchant = User::findOrfail($id);
        $r->validate([

        ]);

        $Merchant = User::findOrfail($id);
        $Merchant->gender = $r->gender;
        $Merchant->birth_date = $r->birth_date;
        $Merchant->address_line_1 = $r->address_line_1;
        $Merchant->address_line_1 = $r->address_line_1;
        $Merchant->address_line_2 = $r->address_line_2;
        $Merchant->governorate_id = $r->governorate_id;
        $Merchant->city_id = $r->city_id;
        $Merchant->save();


        return redirect()->route('dashboard.merchants.index')->with('success', 'User data has been modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Merchant = User::findOrfail($id);
        if (is_file('public/merchants/avatar' . '/' . $Merchant->avatar())) {
            Storage::delete('public/merchants/avatar' . '/' . $Merchant->avatar());
        }
        $Merchant->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }




}
