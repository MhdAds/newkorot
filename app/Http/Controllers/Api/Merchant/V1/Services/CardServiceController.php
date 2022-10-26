<?php

namespace App\Http\Controllers\Api\Merchant\V1\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;

class CardServiceController extends Controller
{

    public function company_services(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $services;
        return res($services, 1, '');
    }

    public function service_categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $categories;

        return res($categories, 1, '');
    }

    public function category_values(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }
        
        $category_values;

        return res($category_values, 1, '');
    }


    
}
