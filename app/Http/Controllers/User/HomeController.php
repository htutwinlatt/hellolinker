<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Session;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (request('searchKey')) {
            return redirect()->route('user#movies', (request()->all()));
        }
        $slideShows = SlideShow::all();
        $popMovies = Movie::orderBy('view_count', 'desc')->limit(12)->get();
        $newMovies = Movie::where('new_arrived', '1')->orderBy('id', 'desc')
            ->get();
        return view('home', compact('newMovies', 'popMovies', 'slideShows'));
    }
}
