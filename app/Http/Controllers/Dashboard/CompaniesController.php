<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\Staff;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|companies-list'])->only(['index']);
        $this->middleware(['permission:super|companies-show'])->only(['show']);
        $this->middleware(['permission:super|companies-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|companies-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|companies-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = Company::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.companies.index', ['companies' => $companies]);
    }

    public function find(Request $r)
    {

        $Companies = Company::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.companies.index', ['Companies' => $Companies, 'text' => $r->text]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_staff = Staff::all();
        return view('dashboard.companies.create', compact(['all_staff']));
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
            'name' => ['required', 'string', 'max:33'],
            'rank' => ['required'],

        ]);
        
        $Company = new Company;
        $Company->name = $r->name;
        $Company->rank = $r->rank;
       
        $Company->save();
        if($r->hasFile('logo')) {
            save_images($Company, $r->logo, 'companies/logo');
        }

        return redirect()->route('dashboard.companies.index')->with('success', 'تم اضافة المكتب بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Company = Company::findOrfail($id);
        $all_staff = Staff::all();

        return view('dashboard.companies.show', compact(['Company', 'all_staff']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Company = Company::findOrfail($id);
        $all_staff = Staff::all();

        return view('dashboard.companies.edit', compact(['Company', 'all_staff']));
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

        $Company = Company::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string', 'max:33'],
            'rank' => ['required'],


        ]);

        $Company = Company::findOrfail($id);

        $Company->name = $r->name;
        $Company->rank = $r->rank;
        $Company->save();
        if($r->hasFile('logo')) {
            if (is_file('public/companies' . '/' . $Company->logo())) {
                Storage::delete('public/companies' . '/' . $Company->logo());
            }
            save_images($Company, $r->logo, 'logo');
        }

        return redirect()->route('dashboard.companies.index')->with('success', 'تم تحديث بيانات المكتب بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Company = Company::findOrfail($id);
        $Company->delete();
        return redirect()->back()->with('success', 'تم حذف بيانات المكتب بنجاح');
    }




}
