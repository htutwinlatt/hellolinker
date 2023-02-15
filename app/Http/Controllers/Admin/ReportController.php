<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::select('type','movie_id',DB::raw('count(*) as report_count'))->groupBy('movie_id')->groupBy('type')->get();
        return view('admin.report.list',compact('reports'));
    }

    public function more(Request $request)
    {
        $reports = Report::select('remark')->where('movie_id',$request->mov_id)->where('type',$request->type)->get();
        return response()->json($reports, 200);
    }

    public function destroy(Request $request)
    {
         Report::where('movie_id',$request->mov_id)->where('type',$request->type)->delete();
        // $reports->delete();
        return response()->json(['success'=>'true'], 200);
    }
}
