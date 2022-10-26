<?php

namespace App\Http\Controllers\Api\Merchant\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Carbon\Carbon;

class CompaniesController extends Controller
{

    public function companies(Request $request)
    {
        $companies = Company::paginate(20);
        return res($companies, 1, '');
    }


    public function company_services($id)
    {
        $Company = Company::find($id);
        $services;
        return res($services, 1, '');
    }

    
}
