<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|services-list'])->only(['index']);
        $this->middleware(['permission:super|services-show'])->only(['show']);
        $this->middleware(['permission:super|services-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|services-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|services-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.services.index', compact('services'));
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
            'name' => 'required|unique:services|max:255',
            'rank' => 'required',
            'logo' => 'required',

        ]);

        $Service = new Service;
        $Service->name = $request->name;
        $Service->rank = $request->rank;
        $Service->save();
        save_images($Service, $request->logo, 'logo');

        return redirect()->route('dashboard.services.index')->with('success', 'Service added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Service = Service::find($id);
        return view('dashboard.services.show', compact('Service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Service = Service::find($id);
        return view('dashboard.services.edit', compact('Service'));
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
            'name' => 'required|max:255',
        ]);

        $Service = Service::findOrfail($id);
        $Service->name = $request->name;
        $Service->rank = $request->rank;
        $Service->save();
        if($request->hasFile('logo')) {
            save_images($Service, $request->logo, 'logo');
        }
        return redirect()->route('dashboard.services.index')->with('success', 'This Service has been successfully updated');
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service_status_update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
           
        ]);

        $Service = Service::findOrfail($id);
        $Service->status = $request->status;
        $Service->save();
       
    
        return redirect()->route('dashboard.services.index')->with('success', 'تم تحديث حالة الخدمة بنجاح');
    }
}
