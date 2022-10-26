<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerchantPackage;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class MerchantPackagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|merchant-packages-list'])->only(['index']);
        $this->middleware(['permission:super|merchant-packages-show'])->only(['show']);
        $this->middleware(['permission:super|merchant-packages-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|merchant-packages-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|merchant-packages-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = MerchantPackage::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.merchant_packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.merchant_packages.create');
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
            'name' => 'required|unique:merchant_packages|max:255',
            'icon' => 'required',
        ]);

        $MerchantPackage = new MerchantPackage;
        $MerchantPackage->name = $request->name;
        $MerchantPackage->save();
        save_images($MerchantPackage, $request->icon, 'icon');

        return redirect()->route('dashboard.merchant-packages.index')->with('success', 'تم اضافة الباقة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MerchantPackage = MerchantPackage::find($id);
        return view('dashboard.merchant_packages.show', compact([
            'MerchantPackage', 
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
        $MerchantPackage = MerchantPackage::find($id);
        return view('dashboard.merchant_packages.edit', compact(['MerchantPackage']));
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

        $MerchantPackage = MerchantPackage::findOrfail($id);
        $MerchantPackage->name = $request->name;
        $MerchantPackage->save();
        if($request->hasFile('icon')) {
            save_images($MerchantPackage, $request->icon, 'icon');
        }
        
        return redirect()->route('dashboard.merchant-packages.index')->with('success', 'تم تحديث الباقة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MerchantPackage = MerchantPackage::findOrfail($id);
        $MerchantPackage->delete();
        return redirect()->route('dashboard.merchant-packages.index')->with('success', 'تم تحديث الباقة بنجاح');
    }
}
