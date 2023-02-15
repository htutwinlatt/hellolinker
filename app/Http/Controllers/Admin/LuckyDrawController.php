<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhoneBill;
use App\Models\PhoneBillControl;
use Illuminate\Http\Request;

class LuckyDrawController extends Controller
{
    public function index()
    {
        $winners = PhoneBill::where('status','!=','lose')->get();
        $control = PhoneBillControl::find(1);
        return view('admin.luckydraw.index',compact('winners','control'));
    }

    public function complete($id)
    {
        $winner = PhoneBill::find($id);
        $winner->update([
            'status'=>'completed'
        ]);
        return back()->with('success','Completed');
    }

    public function reset()
    {
        $control = PhoneBillControl::find(1);
        $control->update([
            'winner_count'=>0,
            'count'=>0,
        ]);
        return back()->with('success','Reset Successful');
    }
}
