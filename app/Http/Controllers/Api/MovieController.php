<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DownloadCount;
use App\Models\Movie;
use App\Models\ViewCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::select('id', 'name', 'image_link', 'image', 'view_count')->when(request('s'), function ($q) {
            $q = Movie::search($q, request('s'));
        })->when(request('orderBy'), function ($q) {
            $orderBy = request('orderBy');
            if ($orderBy == 'popular') {
                $q->orderBy('view_count', 'desc');
            } else if ($orderBy == 'new_arrive') {
                $q->orderBy('id', 'desc');
            }
        })
            ->paginate(20);
        foreach ($movies as $mov) {
            $mov->rating = getMovieRating($mov->id);
            if ($mov->view_count > 1000) {
                $mov->view_count = number_format($mov->view_count / 1000, 1) . 'K';
            }
            if (!$mov->image_link) {
                $mov->image_link = Storage::url('movie_photos/' . $mov->image);
            }
        }
        return response()->json($movies, 200);
    }

    // Show Movie Info
    public function show($id)
    {
        $movie = Movie::find($id)->makeHidden(['link', 'episodes']);
        $view = ViewCount::whereDate('created_at', Carbon::today())->first();
        if ($view) {
            $view->update([
                'count' => $view->count + 1,
            ]);
        } else {
            ViewCount::create([
                'count' => 1,
            ]);
        }
        $movie->update([
            'view_count' => $movie->view_count + 1,
        ]);
        $movie->rating = getMovieRating($movie->id);
        if (!$movie->image_link) {
            $movie->image_link .= config('app.url') . '/' . Storage::url('movie_photos/' . $movie->image);

        }
        $data = [
            'movie' => $movie,
        ];
        return response()->json($data, 200);
    }

    // Get Random Movie With Type
    public function random($type, $count)
    {
        $types = explode(',', $type);
        $movies = Movie::where(function ($q) use ($types) {
            foreach ($types as $t) {
                $q->orWhere('type', 'like', '%' . $t . '%');
            }
        })->limit($count)->get()->makeHidden(['link', 'episodes'])->each(function ($mov) {
            $mov->rating = getMovieRating($mov->id);
        });
        return response()->json($movies, 200);
    }

    //Get DownloadLink
    public function get_link(Request $request)
    {
        $movie = Movie::select('link', 'episodes', 'download_count', 'id')->where('id', $request->id)->where('name', $request->name)->where('trailer', $request->trailer)->first();
        $movie->update([
            'download_count' => $movie->download_count + 1,
        ]);
        $download = DownloadCount::whereDate('created_at', Carbon::today())->first();
        if ($download) {
            $download->update([
                'count' => $download->count + 1,
            ]);
        } else {
            DownloadCount::create([
                'count' => 1,
            ]);
        }
        return response()->json($movie, 200);
    }

    //Get Categories List
    public function category()
    {
        $data = Cache::remember('categories_list', 60 * 60, function () {
            $categories = Movie::select('type as data')->get();
            return $this->get_array($categories, ',');
        });
        return response()->json($data, 200);
    }

    // Get Movie By One Type
    public function get_movies_by_type(Request $request)
    {
        $movies = Movie::select('id', 'name', 'image_link', 'image', 'view_count')
            ->where('type', 'like', '%' . $request->category . '%')->paginate(20);
        foreach ($movies as $mov) {
            $mov->rating = getMovieRating($mov->id);
            if ($mov->view_count > 1000) {
                $mov->view_count = number_format($mov->view_count / 1000, 1) . 'K';
            }
            if (!$mov->image_link) {
                $mov->image_link = config('app.url') . '/' . Storage::url('movie_photos/' . $mov->image);
            }
        }
        return response()->json($movies, 200);

    }

    //Get Actors List
    public function actors()
    {
        $cacheKey = 'actors_list';
        $cacheTime = 60 * 60;
        $actors = Cache::remember($cacheKey, $cacheTime, function () {
            $movies = Movie::select('actors as data')->whereNotIn('actors', ['-', ''])->get();
            return $this->get_array($movies, ',');
        });
        return response()->json($actors, 200);
    }

    public function get_movies_by_actors(Request $request)
    {

        $movies = Movie::select('id', 'name', 'image_link', 'image', 'view_count')
            ->where('actors', 'like', '%' . $request->actor . '%')->paginate(20);
        foreach ($movies as $mov) {
            $mov->rating = getMovieRating($mov->id);
            if ($mov->view_count > 1000) {
                $mov->view_count = number_format($mov->view_count / 1000, 1) . 'K';
            }
            if (!$mov->image_link) {
                $mov->image_link = config('app.url') . '/' . Storage::url('movie_photos/' . $mov->image);
            }
        }
        return response()->json($movies, 200);
    }

    //ned to add string $array->data to split
    private function get_array($array, $seprate)
    {
        $data = [];
        foreach ($array as $category) {
            $data_array = explode($seprate, $category->data);
            foreach ($data_array as $key) {
                $key = trim($key, " ");
                $key = strtolower($key);
                if (!in_array($key, $data) && $key != '') {
                    array_push($data, $key);
                }
            }
        }

        return $data;
    }

}
