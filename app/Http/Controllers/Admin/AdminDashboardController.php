<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\DownloadCount;
use App\Models\Movie;
use App\Models\Report;
use App\Models\Session;
use App\Models\User;
use App\Models\ViewCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRating = Comment::sum('rating');
        $totalComment = Comment::all()->count();
        $totalMovies = Movie::all()->count();
        $activeUsers = Session::where('user_id','!=',NULL)->count();
        $reports = Report::count();
        $totalViews = Movie::sum('view_count');
        $todayView = ViewCount::whereDate('created_at',Carbon::today())->first();
        $todayDownload = DownloadCount::whereDate('created_at',Carbon::today())->first();
        $userRoleCounts = DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
        return view(
            'admin.dashboard.list',
            compact('userRoleCounts','totalRating','totalMovies','activeUsers','totalViews','totalComment','todayView','reports','todayDownload')
        );
    }

    public function view_count(Request $request)
    {
        $form = date($request->from);
        $to = Carbon::parse($request->to)->addDay(1);
        $views = ViewCount::select('created_at','count')->whereBetween('created_at',[$form,$to])->get()->each(function($q){
            $q->label = $q->created_at->format('Y-m-d');
            return $q;
        });
        $downloads = DownloadCount::select('created_at','count')->whereBetween('created_at',[$form,$to])->get()->each(function($q){
            $q->label = $q->created_at->format('Y-m-d');
            return $q;
        });
        $todayView = ViewCount::whereDate('created_at',Carbon::today())->first();
        $data = [
            'view_table'=>$views,
            'download_table'=>$downloads,
            'today_view_count'=>$todayView ?  $todayView->count : 0
        ];
        return response()->json($data, 200);
    }
}
