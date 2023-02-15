<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\ViewCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::when(request('searchKey'), function ($q) {
            Movie::search($q, request('searchKey'));
        })
            ->orderBy('id', 'desc')->paginate(15);
        return view('user.movies', compact('movies'));
    }

    //Showing Abouts Movie
    public function info($id)
    {
        $totalCmt = Comment::where('movie_id', $id)->count();
        $comments = Comment::where('movie_id', $id)
            ->orderBy('id', 'desc')->limit(3)->get();
        $rmovies = Movie::inRandomOrder()->whereNotIn('id', [$id])->limit(10)->get();
        $movie = Movie::find($id);
        $movie->update([
            'view_count' => $movie->view_count += 1,
        ]);
        $view = ViewCount::whereDate('created_at',Carbon::today())->first();
        if ($view) {
            $view->update([
                'count'=>$view->count+1,
            ]);
        }else{
            ViewCount::create([
                'count'=>1
            ]);
        }
        return view('user.movie_info', compact('movie', 'rmovies', 'comments', 'id', 'totalCmt'));
    }

    //Get Movie Link
    public function get_link($id,$name)
    {
        $movie = Movie::find($id);
        return view('user.others.watch_movie',compact('movie'));
    }

    //Category
    public function category_list()
    {
        $categories = Movie::select('type')->get();
        return response()->json($categories, 200);
    }

    public function category_page()
    {
        return view('user.category');
    }

    public function search_by_category($id)
    {
        $movies = Movie::where('type','like','%'.$id.'%')->orderBy('created_at','desc')->paginate(15);
        return view('user.movies', compact('movies'));
    }


    private function getMovieUrl($movie)
    {
        if ($movie->role != 'free') {
            return view('errors.ispremium');
        } else {
            return redirect()->away($movie->link);
        }
    }
}
