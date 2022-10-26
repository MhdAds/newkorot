<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\City;

class AjaxController extends Controller
{

    public function doctors(Request $r)
    {
        $r->validate([
            'doctors_search' => ['required'],
        ]);
        $title = 'Select a Doctor';
        $error = 'No results found';

        // if ($r->city_id != null) {
        //     $options = Doctor::where('city_id', $r->city_id)
        //     ->where('name', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('email', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_1', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_2', 'like', '%' . $r->doctors_search . '%')
        //     ->limit(10)
        //     ->pluck("name","id")
        //     ->all();
        // } elseif ($r->governorate_id != null && $r->city_id == null) {
        //     $options = Doctor::where('governorate_id', $r->governorate_id)
        //     ->where('name', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('email', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_1', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_2', 'like', '%' . $r->doctors_search . '%')
        //     ->limit(10)
        //     ->pluck("name","id")
        //     ->all();
        // } else {
        //     $options = Doctor::where('name', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('email', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_1', 'like', '%' . $r->doctors_search . '%')
        //     ->orWhere('phone_2', 'like', '%' . $r->doctors_search . '%')
        //     ->limit(10)
        //     ->pluck("name","id")
        //     ->all();
        // }

        $options = Doctor::where('governorate_id', $r->governorate_id)
            ->where('name', 'like', '%' . $r->doctors_search . '%')
            ->orWhere('email', 'like', '%' . $r->doctors_search . '%')
            ->orWhere('phone_1', 'like', '%' . $r->doctors_search . '%')
            ->orWhere('phone_2', 'like', '%' . $r->doctors_search . '%')
            ->limit(10)
            ->pluck("name","id")
            ->all();
        

        

        $data = view('dashboard.ajax_templates.select_doctor',compact(['options', 'title', 'error']))->render();
        return response()->json(['options' => $data]);
    }


    public function doctor_clinics(Request $r)
    {
        $r->validate([
            'doctor_id' => ['required'],
        ]);
        $title = 'Select a clinic';
        $error = 'No results found';
        $options = Clinic::where('doctor_id', $r->doctor_id)->pluck("address","id")->all();
        $data = view('dashboard.ajax_templates.select_options',compact(['options', 'title', 'error']))->render();
        return response()->json(['options' => $data]);
    }

    public function cities_by_governorate_id(Request $r)
    {
        $r->validate([
            'governorate_id' => ['required'],
        ]);
        $title = 'Select a city';
        $error = 'No results found';
        $options = City::where('governorate_id', $r->governorate_id)->pluck("name","id")->all();
        $data = view('dashboard.ajax_templates.select_options',compact(['options', 'title', 'error']))->render();
        return response()->json(['options' => $data]);
    }


    public function new_clinic(Request $r)
    {
        $doctors = Doctor::all();
        $count = $r->count;

        return view('dashboard.ajax_templates.new_clinics',compact(['doctors', 'count']))->render();
    }
}
