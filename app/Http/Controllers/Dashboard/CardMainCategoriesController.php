<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CardMainCategory;
use Carbon\Carbon;

class CardMainCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:super|card-main-categories-list'])->only(['index']);
        $this->middleware(['permission:super|card-main-categories-show'])->only(['show']);
        $this->middleware(['permission:super|card-main-categories-create'])->only(['create', 'store']);
        $this->middleware(['permission:super|card-main-categories-edit'])->only(['edit', 'update']);
        $this->middleware(['permission:super|card-main-categories-destroy'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {
        $categories  = CardMainCategory::orderBy('id', 'desc')->where('company_id', $company_id)->paginate(20);
        return view('dashboard.card_main_categories.index', compact(['company_id', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id)
    {
        return view('dashboard.card_main_categories.create', compact(['company_id']));
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
            'company_id' => 'required',
            'rank' => 'required',
            'description' => 'required',
        ]);


        $CardMainCategory = new CardMainCategory;
        $CardMainCategory->name = $request->name;
        $CardMainCategory->company_id = $request->company_id;
        $CardMainCategory->rank = $request->rank;
        $CardMainCategory->description = $request->description;
        $CardMainCategory->save();

        return redirect()->route('dashboard.card-main-categories.index', $CardMainCategory->company_id)->with('success', 'CardMainCategory added successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $CardMainCategory = CardMainCategory::find($id);

        return view('dashboard.card_main_categories.show', compact(['CardMainCategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $CardMainCategory = CardMainCategory::find($id);
        return view('dashboard.card_main_categories.edit', compact(['CardMainCategory']));
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


        $CardMainCategory = CardMainCategory::findOrfail($id);
        $CardMainCategory->name = $request->name;
        $CardMainCategory->rank = $request->rank;
        $CardMainCategory->description = $request->description;
        $CardMainCategory->save();

        return redirect()->route('dashboard.card-main-categories.index', $CardMainCategory->company_id)->with('success', 'This CardMainCategory has been successfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CardMainCategory = CardMainCategory::findOrfail($id);
        $company_id = $CardMainCategory->company_id;
        $CardMainCategory->delete();
        return redirect()->route('dashboard.card-main-categories.index', $company_id)->with('success', 'This CardMainCategory has been successfully deleted');
    }
}
