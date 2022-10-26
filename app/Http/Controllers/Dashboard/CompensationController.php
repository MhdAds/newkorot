<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Compensation;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

use Carbon\Carbon;

class CompensationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:super|compensation-list'])->only(['index']);
        $this->middleware(['permission:super|compensation-show'])->only(['show']);
        $this->middleware(['permission:super|compensation-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|compensation-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|compensation-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $compensations = Compensation::paginate(20);
        return view('dashboard.compensation.index', compact([
            'compensations',
        ]));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_compensation($user_id)
    {

        $compensation = Compensation::where('user_id', $user_id)->paginate(20);
        return view('dashboard.compensation.index', compact([
            'compensation',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.compensation.create', compact(['users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'value' => 'required',
            
        ]);



        $Compensation = new Compensation;
        $Compensation->staff_id = auth()->user()->id;
        $Compensation->user_id = $request->user_id;
        $Compensation->notes = $request->notes;
        $Compensation->value = $request->value;
        $Compensation->save();
        
 
        return redirect()->route('dashboard.compensation.index')->with('success', 'تم اضافة التعويض بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Compensation = Compensation::find($id);
        $users = User::all();
        return view('dashboard.compensation.show', compact(['Compensation', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Compensation = Compensation::find($id);
        $users = User::all();
        return view('dashboard.compensation.edit', compact(['Compensation', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'value' => 'required',
            
        ]);

        $Compensation = Compensation::findOrfail($id);
        $Compensation->user_id = $request->user_id;
        $Compensation->value = $request->value;
        $Compensation->notes = $request->notes;
        $Compensation->save();
        

        return redirect()->route('dashboard.compensation.index')->with('success', 'تم تحديث بيانات التعويض بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Compensation = Compensation::findOrfail($id);
        $Compensation->delete();
        return redirect()->route('dashboard.compensation.index')->with('success', 'تم حذف التعويض بنجاح');
    }
}
