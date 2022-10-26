<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddCreditRequest;
use App\Models\User;

class AddCreditRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:super|add-credit-withdrawal-requests-list'])->only(['index']);
        $this->middleware(['permission:super|add-credit-withdrawal-requests-show'])->only(['show']);
        $this->middleware(['permission:super|add-credit-withdrawal-requests-edit'])->only(['edit', 'update']);
    }


    public function index()
    {
        $AddCreditRequests = AddCreditRequest::latest()->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function new_requests()
    {
        $AddCreditRequests = AddCreditRequest::latest()->where('status', 0)->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function watched_requests()
    {
        $AddCreditRequests = AddCreditRequest::latest()->where('status', 1)->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function accepted_requests()
    {
        $AddCreditRequests = AddCreditRequest::latest()->where('status', 2)->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function transferred_requests()
    {
        $AddCreditRequests = AddCreditRequest::latest()->where('status', 3)->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function rejected_requests()
    {
        $AddCreditRequests = AddCreditRequest::latest()->where('status', 6)->paginate(20);
        return view('dashboard.add_credit_withdrawal_requests.index', ['AddCreditRequests' => $AddCreditRequests]);
    }

    public function show($id)
    {
        $AddCreditRequest = AddCreditRequest::findOrfail($id);

        if ($AddCreditRequest->status == 0) {
            $AddCreditRequest->status = 1;
            $AddCreditRequest->save();
        }

        return view('dashboard.add_credit_withdrawal_requests.show', ['AddCreditRequest' => $AddCreditRequest]);
    }

    public function update(Request $r, $id)
    {
        $userAddCreditRequest = AddCreditRequest::findOrfail($id);
        $userAddCreditRequest->status = $r->status;
        $userAddCreditRequest->staff_notes = $r->staff_notes;
        $userAddCreditRequest->save();

        
        if ($r->status == 3) {
            $User = User::findOrfail($userAddCreditRequest->user_id);
            $User->balance += $userAddCreditRequest->value;
            $User->save();
        }
        
        
        return redirect()->back()->with('success', 'تم تحديث حالة عملية بنجاح'); 
    }
}
