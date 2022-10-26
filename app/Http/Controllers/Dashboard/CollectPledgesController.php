<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pledge;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

use Carbon\Carbon;

class CollectPledgesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:super|collect-pledges-list'])->only(['index']);
        $this->middleware(['permission:super|collect-pledges-show'])->only(['show']);
        $this->middleware(['permission:super|collect-pledges-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|collect-pledges-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|collect-pledges-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $collect_pledges = Pledge::where('type', 'collect')->paginate(20);
        return view('dashboard.collect_pledges.index', compact([
            'collect_pledges',
        ]));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order_pledges($user_id)
    {

        $pledges = Pledge::where('user_id', $user_id)->paginate(20);
        return view('dashboard.collect_pledges.index', compact([
            'pledges',
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
        return view('dashboard.collect_pledges.create', compact(['users']));
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


        $Pledge = new Pledge;
        $Pledge->staff_id = auth()->user()->id;
        $Pledge->user_id = $request->user_id;
        $Pledge->notes = $request->notes;
        $Pledge->value = $request->value;
        $Pledge->type = 'collect';
        $Pledge->save();
        
 
        return redirect()->route('dashboard.collect-pledges.index')->with('success', 'تم اضافة التعهد بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Pledge = Pledge::find($id);
        $users = User::all();
        return view('dashboard.collect_pledges.show', compact(['Pledge', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Pledge = Pledge::find($id);
        $users = User::all();
        return view('dashboard.collect_pledges.edit', compact(['Pledge', 'users']));
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

        $Pledge = Pledge::findOrfail($id);
        $Pledge->user_id = $request->user_id;
        $Pledge->value = $request->value;
        $Pledge->notes = $request->notes;
        $Pledge->save();
        

        return redirect()->route('dashboard.collect-pledges.index')->with('success', 'تم تحديث بيانات التعهد بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Pledge = Pledge::findOrfail($id);
        $Pledge->delete();
        return redirect()->route('dashboard.collect-pledges.index')->with('success', 'تم حذف التعهد بنجاح');
    }
}
