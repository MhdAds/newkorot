<?php

namespace App\Http\Controllers\Api\Merchant\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\CardOrder;
use Carbon\Carbon;

class OrdersController extends Controller
{

    public function store_card_order(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            // 'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return res(null, 0, $validator->errors());
        }

        $Order = new Order;
        $Order->user_id = request()->user()->id;
        $Order->service_id = $request->service_id;
        $Order->unit_selling_price = 0;
        $Order->unit_buying_price = 0;
        $Order->total_selling_price = 0;
        $Order->total_buying_price = 0;
        $Order->quantity = $request->quantity;
        $Order->save();

        $CardOrder = new CardOrder;
        $CardOrder->order_id = $Order->id;
        $CardOrder->card_categor_id = $request->card_categor_id;
        $CardOrder->card_id = $request->card_id;
        $CardOrder->save();


        return res($Order, 1, '');
    }


    public function card_orders_history()
    {
        $Orders = Order::where('service_id', 1)->where('user_id', request()->user()->id)->with('card_order.cards')->paginate(20);
        return res($Orders, 1, '');
    }

    
}
