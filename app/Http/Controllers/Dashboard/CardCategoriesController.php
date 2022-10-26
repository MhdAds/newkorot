<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\User;
use App\Models\CardCategory;
use App\Models\Clinic;
use App\Models\CardCategoryVisit;
use Carbon\Carbon;

class CardCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|card-categories-list'])->only(['index']);
        $this->middleware(['permission:super|card-categories-show'])->only(['show']);
        $this->middleware(['permission:super|card-categories-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|card-categories-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|card-categories-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($card_main_category_id)
    {
        $categories  = CardCategory::orderBy('id', 'desc')->where('card_main_category_id', $card_main_category_id)->paginate(20);
        return view('dashboard.card_categories.index', compact(['card_main_category_id', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($card_main_category_id)
    {
        return view('dashboard.card_categories.create', compact(['card_main_category_id']));
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
            'name' => 'required|max:255',
            'card_main_category_id' => 'required',
            'rank' => 'required',
            'description' => 'required',
        ]);


        $CardCategory = new CardCategory;
        $CardCategory->name = $request->name;
        $CardCategory->card_main_category_id = $request->card_main_category_id;
        $CardCategory->rank = $request->rank;
        $CardCategory->description = $request->description;
        $CardCategory->save();

        return redirect()->route('dashboard.card-categories.index', $CardCategory->card_main_category_id)->with('success', 'CardCategory added successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $CardCategory = CardCategory::find($id);

        return view('dashboard.card_categories.show', compact(['CardCategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $CardCategory = CardCategory::find($id);
        return view('dashboard.card_categories.edit', compact(['CardCategory']));
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
            'name' => 'required|max:255',
            'rank' => 'required',
            'description' => 'required',
        ]);


        $CardCategory = CardCategory::findOrfail($id);
        $CardCategory->name = $request->name;
        $CardCategory->rank = $request->rank;
        $CardCategory->description = $request->description;
        $CardCategory->save();

        return redirect()->route('dashboard.card-categories.index', $CardCategory->card_main_category_id)->with('success', 'This CardCategory has been successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CardCategory = CardCategory::findOrfail($id);
        $card_main_category_id = $CardCategory->card_main_category_id;
        $CardCategory->delete();
        return redirect()->route('dashboard.card-categories.index', $card_main_category_id)->with('success', 'This CardCategory has been successfully deleted');
    }
}
