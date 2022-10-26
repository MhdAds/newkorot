<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Indebtedness;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

use Carbon\Carbon;

class IndebtednessController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:super|indebtedness-list'])->only(['index']);
        $this->middleware(['permission:super|indebtedness-show'])->only(['show']);
        $this->middleware(['permission:super|indebtedness-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|indebtedness-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|indebtedness-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $indebtedness = Indebtedness::where('type', 'deposit')->paginate(20);
        return view('dashboard.indebtedness.index', compact([
            'indebtedness',
        ]));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_indebtedness($user_id)
    {

        $indebtedness = Indebtedness::where('user_id', $user_id)->paginate(20);
        return view('dashboard.indebtedness.index', compact([
            'indebtedness',
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
        return view('dashboard.indebtedness.create', compact(['users']));
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



        $Indebtedness = new Indebtedness;
        $Indebtedness->staff_id = auth()->user()->id;
        $Indebtedness->user_id = $request->user_id;
        $Indebtedness->notes = $request->notes;
        $Indebtedness->value = $request->value;
        $Indebtedness->type = 'deposit';
        $Indebtedness->save();
        
 
        return redirect()->route('dashboard.indebtedness.index')->with('success', 'تم اضافة المديونية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Indebtedness = Indebtedness::find($id);
        $users = User::all();
        return view('dashboard.indebtedness.show', compact(['Indebtedness', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Indebtedness = Indebtedness::find($id);
        $users = User::all();
        return view('dashboard.indebtedness.edit', compact(['Indebtedness', 'users']));
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

        $Indebtedness = Indebtedness::findOrfail($id);
        $Indebtedness->user_id = $request->user_id;
        $Indebtedness->value = $request->value;
        $Indebtedness->notes = $request->notes;
        $Indebtedness->save();
        

        return redirect()->route('dashboard.indebtedness.index')->with('success', 'تم تحديث بيانات المديونية بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Indebtedness = Indebtedness::findOrfail($id);
        $Indebtedness->delete();
        return redirect()->route('dashboard.indebtedness.index')->with('success', 'تم حذف المديونية بنجاح');
    }
}
