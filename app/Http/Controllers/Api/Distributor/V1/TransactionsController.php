<?php

namespace App\Http\Controllers\Api\Distributor\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Debt;

class TransactionsController extends Controller
{
    
    public function transactions__history(Request $request)
    {
        $transactions = Transaction::where('user_id', request()->user()->id)->paginate(20);
        return res($transactions, 1, '');
    }

    public function transfer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'merchant_id' => 'required',
            'value' => 'required',
            'type' => 'required',

        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $distributor = User::find(request()->user()->id);
        $merchant = User::find($request->merchant_id);

        if ($distributor->balance < $request->value) {
            return res('', 0, 'رصيدك الحالي لا يكفي');
        }

        $Transaction = new Transaction;
        $Transaction->user_id = request()->user()->id;
        $Transaction->spend_id = $request->merchant_id;
        $Transaction->type = 'spend'; 
        $Transaction->spend_type = 'send'; 
        $Transaction->value = $request->value;
        $Transaction->source_id = request()->user()->id;
        $Transaction->save();

        
        if ($request->type = 'deposit') {
            $Debt = new Debt;
            $Debt->borrower_id = request()->user()->id;
            $Debt->debtor_id = $request->merchant_id;
            $Debt->type = 'deposit'; 
            $Debt->value = $request->value;
            $Debt->save();
        }

        if ($request->type = 'deposit') {
            $distributor->debts -= $Transaction->value;
        }
        
        $distributor->balance -= $Transaction->value;
        $distributor->save();

        if ($request->type = 'deposit') {
            $merchant->debts += $Transaction->value;
        }

        
        $merchant->balance += $Transaction->value;
        $merchant->save();

        return res('', 1, 'تم تنفيذ العملية بنجاح');
    }

    public function collected(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merchant_id' => 'required',
            'value' => 'required',

        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $distributor = User::find(request()->user()->id);
        $merchant = User::find($request->merchant_id);




        $Debt = new Debt;
        $Debt->borrower_id = request()->user()->id;
        $Debt->debtor_id = $request->merchant_id;
        $Debt->type = 'collect'; 
        $Debt->value = $request->value;
        $Debt->save();

        $distributor->total_collect += $Transaction->value;
        $distributor->save();

        $merchant->debts -= $Transaction->value;
        $merchant->save();

        return res('', 1, 'تم تنفيذ العملية بنجاح');
    }

}
