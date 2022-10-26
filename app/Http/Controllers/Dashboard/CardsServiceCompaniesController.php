<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Models\Company;

use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class CardsServiceCompaniesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|cards-service-companies-list'])->only(['index']);
        $this->middleware(['permission:super|cards-service-companies-show'])->only(['show']);
        $this->middleware(['permission:super|cards-service-companies-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|cards-service-companies-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|cards-service-companies-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_companies = Company::orderBy('id', 'desc')->paginate(20);
        $cards_service_companies = ServiceCompany::where('service_id', 1)->pluck('company_id')->toArray();
        
        return view('dashboard.cards_service_companies.index', compact([
            'all_companies',
            'cards_service_companies'
        ]));
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
            'status' => 'required',
            'service_id' => 'required',
           
        ]);

        if ($request->status == 1) {

            $ServiceCompany = ServiceCompany::where('company_id', $id)->first();

            // dd($ServiceCompany);
            if ($ServiceCompany == null) {
                $ServiceCompany = new ServiceCompany;
                $ServiceCompany->company_id = $id;
                $ServiceCompany->service_id = $request->service_id;
                $ServiceCompany->save();
            }
            
        } else {
            $ServiceCompany = ServiceCompany::where('company_id', $id)->first();
            $ServiceCompany->delete();
        }
       
    
        return redirect()->route('dashboard.cards-service-companies.index')->with('success', 'تم تحديث حالة الشركة بنجاح');
    }

    
}
