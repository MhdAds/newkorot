<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;

class HelpController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:super|help-list'])->only(['index']);
        $this->middleware(['permission:super|help-show'])->only(['show']);
        $this->middleware(['permission:super|help-edit'])->only(['edit', 'update']);
    }


    public function index()
    {
        $Helps = Help::latest()->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function new_help()
    {
        $Helps = Help::latest()->where('status', 0)->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function watched_help()
    {
        $Helps = Help::latest()->where('status', 1)->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function accepted_help()
    {
        $Helps = Help::latest()->where('status', 2)->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function transferred_help()
    {
        $Helps = Help::latest()->where('status', 3)->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function rejected_help()
    {
        $Helps = Help::latest()->where('status', 6)->paginate(20);
        return view('dashboard.help.index', ['Helps' => $Helps]);
    }

    public function show($id)
    {
        $Help = Help::findOrfail($id);

        if ($Help->status == 0) {
            $Help->status = 1;
            $Help->save();
        }

        return view('dashboard.help.show', ['Help' => $Help]);
    }

    public function update(Request $r, $id)
    {
        $userHelp = Help::findOrfail($id);
        $userHelp->status = $r->status;
        $userHelp->staff_notes = $r->staff_notes;
        $userHelp->save();

        
        
        
        return redirect()->back()->with('success', 'تم تحديث حالة الرسالة بنجاح'); 
    }
}
