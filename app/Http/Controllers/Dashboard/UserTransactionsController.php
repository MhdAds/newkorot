<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pledge;
use App\Models\Indebtedness;
use App\Models\Compensation;
use App\Models\AddCreditRequest;
use App\Models\ProfitWithdrawalRequest;
use App\Models\ProfitToBalance;


class UserTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:super|add-credit-withdrawal-requests-list'])->only(['index']);
        $this->middleware(['permission:super|add-credit-withdrawal-requests-show'])->only(['show']);
        $this->middleware(['permission:super|add-credit-withdrawal-requests-edit'])->only(['edit', 'update']);
    }


    public function all_transactions($user_id)
    {
        $Transactions = Transaction::where('user_id', $user_id)->latest()->paginate(20);
        return view('dashboard.user_transactions.all_transactions', compact(['Transactions']));
    }

    public function show_transaction($id)
    {
        $Transaction = Transaction::firstOrFail($id);
        return view('dashboard.user_transactions.show_transaction', compact(['Transaction']));
    }

    public function all_transfer_profits_to_user_balance($user_id)
    {
        $Transactions = ProfitToBalance::where('user_id', $user_id)->latest()->paginate(20);
        return view('dashboard.user_transactions.transfer_profits_to_user_balance', compact(['Transactions']));
    }

    public function show_transfer_profits_to_user_balance($id)
    {
        $Transaction = ProfitToBalance::firstOrFail($id);
        return view('dashboard.user_transactions.show_transfer_profits_to_user_balance', compact(['Transaction']));
    }

    public function all_pledges($user_id)
    {
        $Transactions = Pledge::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.all_pledges', compact(['Transactions']));
    }
    

    public function collect_pledges($user_id)
    {
        $Transactions = Pledge::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.collect_pledges', compact(['Transactions']));
    }

    public function show_pledge($id)
    {
        $Transaction = Pledge::firstOrFail($id);
        return view('dashboard.user_transactions.show_pledge', compact(['Transaction']));
    }
    
    public function all_indebtedness($user_id)
    {
        $Transactions = Indebtedness::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.all_indebtedness', compact(['Transactions']));
    }


    public function collect_indebtedness($user_id)
    {
        $Transactions = Indebtedness::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.collect_indebtedness', compact(['Transactions']));
    }

    public function show_indebtedness($id)
    {
        $Transaction = Indebtedness::firstOrFail($id);
        return view('dashboard.user_transactions.show_indebtedness', compact(['Transaction']));
    }


    public function all_compensation($user_id)
    {
        $Transactions = Compensation::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.all_compensation', compact(['Transactions']));
    }

    public function show_compensation($id)
    {
        $Transaction = Compensation::firstOrFail($id);
        return view('dashboard.user_transactions.show_compensation', compact(['Transaction']));
    }

    public function all_profit_withdrawal_requests($user_id)
    {
        $Transactions = ProfitWithdrawalRequest::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.all_profit_withdrawal_requests', compact(['Transactions']));
    }

    public function show_profit_withdrawal_request($id)
    {
        $Transaction = ProfitWithdrawalRequest::firstOrFail($id);
        return view('dashboard.user_transactions.show_profit_withdrawal_request', compact(['Transaction']));
    }

    public function all_add_credit_withdrawal_requests($user_id)
    {
        $Transactions = AddCreditRequest::latest()->where('user_id', $user_id)->paginate(20);
        return view('dashboard.user_transactions.all_add_credit_withdrawal_requests', compact(['Transactions']));
    }

    public function show_add_credit_withdrawal_request($id)
    {
        $Transaction = AddCreditRequest::firstOrFail($id);
        return view('dashboard.user_transactions.show_add_credit_withdrawal_request', compact(['Transaction']));
    }

    // public function show($id)
    // {
    //     $Transaction = Transaction::findOrfail($id);

    //     if ($Transaction->status == 0) {
    //         $Transaction->status = 1;
    //         $Transaction->save();
    //     }

    //     return view('dashboard.user_transactions.show', ['Transaction' => $Transaction]);
    // }

    // public function update(Request $r, $id)
    // {
    //     $userTransaction = Transaction::findOrfail($id);
    //     $userTransaction->status = $r->status;
    //     $userTransaction->staff_notes = $r->staff_notes;
    //     $userTransaction->save();

        
    //     if ($r->status == 3) {
    //         $User = User::findOrfail($userTransaction->user_id);
    //         $User->balance += $userTransaction->value;
    //         $User->save();
    //     }
        
        
    //     return redirect()->back()->with('success', 'تم تحديث حالة عملية بنجاح'); 
    // }
}
