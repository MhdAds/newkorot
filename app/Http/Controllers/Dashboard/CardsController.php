<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CardsImport;
use App\Models\CardCategory;
use App\Models\Card;


class CardsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|cards-list'])->only(['index']);
        $this->middleware(['permission:super|cards-show'])->only(['show']);
        $this->middleware(['permission:super|cards-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|cards-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|cards-destroy'])->only(['destroy']);
    }

    public function import(Request $request) 
    {
        $request->validate([
            'cards' => 'required',
            'category_id' => 'required',

        ]);
        Excel::import(new CardsImport($request->category_id), $request->file('cards'));
        return redirect()->back()->with('success', 'cards have been successfully imported');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($card_category_id)
    {
        $cards = Card::orderBy('id', 'desc')->paginate(20);
        $CardCategory = CardCategory::find($card_category_id);
        return view('dashboard.cards.index', compact(['cards', 'CardCategory']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id)
    {
        return view('dashboard.cards.create', compact(['category_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'code' => 'required',
            'expiry_date' => 'required',
            'buy_price' => 'required',

        ]);

   

        $Card = new Card;
        $Card->category_id = $request->category_id;
        $Card->code = $request->code;
        $Card->expiry_date = $request->expiry_date;
        $Card->buy_price = $request->buy_price;

        $Card->save();

        return redirect()->route('dashboard.cards.index', $request->category_id)->with('success', 'card added successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Card = Card::find($id);
        return view('dashboard.cards.show', compact(['Card']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Card = Card::find($id);
        return view('dashboard.cards.edit', compact(['Card']));
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
            'code' => 'required',
            'expiry_date' => 'required',
            'buy_price' => 'required',

        ]);


        $Card = Card::findOrfail($id);
        $Card->code = $request->code;
        $Card->expiry_date = $request->expiry_date;
        $Card->buy_price = $request->buy_price;

        $Card->save();

        return redirect()->route('dashboard.cards.edit', $Card->category_id)->with('success', 'This card has been successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Card = Card::findOrfail($id);
        $category_id = $Card->category_id;
        $Card->delete();
        return redirect()->route('dashboard.cards.edit', $category_id)->with('success', 'This card has been successfully deleted');
    }
}
