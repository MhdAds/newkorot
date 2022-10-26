<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfitWithdrawalRequest;
use App\Models\User;

class ProfitWithdrawalRequestsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|profit-withdrawal-requests-list'])->only(['index']);
        $this->middleware(['permission:super|profit-withdrawal-requests-show'])->only(['show']);
        $this->middleware(['permission:super|profit-withdrawal-requests-edit'])->only(['edit', 'update']);
    }


    public function index()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function new_requests()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->where('status', 0)->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function watched_requests()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->where('status', 1)->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function accepted_requests()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->where('status', 2)->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function transferred_requests()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->where('status', 3)->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function rejected_requests()
    {
        $ProfitWithdrawalRequests = ProfitWithdrawalRequest::latest()->where('status', 6)->paginate(20);
        return view('dashboard.profit_withdrawal_requests.index', ['ProfitWithdrawalRequests' => $ProfitWithdrawalRequests]);
    }

    public function show($id)
    {
        $ProfitWithdrawalRequest = ProfitWithdrawalRequest::findOrfail($id);

        if ($ProfitWithdrawalRequest->status == 0) {
            $ProfitWithdrawalRequest->status = 1;
            $ProfitWithdrawalRequest->save();
        }

        return view('dashboard.profit_withdrawal_requests.show', ['ProfitWithdrawalRequest' => $ProfitWithdrawalRequest]);
    }

    public function update(Request $r, $id)
    {
        $userProfitWithdrawalRequest = ProfitWithdrawalRequest::findOrfail($id);
        $userProfitWithdrawalRequest->status = $r->status;
        $userProfitWithdrawalRequest->staff_notes = $r->staff_notes;
        $userProfitWithdrawalRequest->save();

        
        if ($r->status == 3) {
            $User = User::findOrfail($userProfitWithdrawalRequest->user_id);
            $User->profits -= $userProfitWithdrawalRequest->value;
            $User->save();
        }
        
        
        return redirect()->back()->with('success', 'تم تحديث حالة عملية بنجاح'); 
    }

}
