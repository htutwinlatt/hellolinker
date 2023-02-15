<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\SlideShow;

class HomePageController extends Controller
{
    public function index()
    {
        $slideShow = SlideShow::all();
        $popMovies = Movie::orderBy('view_count', 'desc')->limit(12)->get()->makeHidden(['link', 'episodes', 'trailer']);
        $newMovies = Movie::where('new_arrived', '1')->orderBy('id', 'desc')->get()->makeHidden(['link', 'episodes', 'trailer']);
        $data = [
            'slideShow' => $slideShow,
            'popularMovies' => $popMovies,
            'newMovies' => $newMovies,
        ];
        return response()->json($data, 200);
    }
}
