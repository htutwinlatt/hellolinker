<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Movie;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function allmoviemm(Request $request)
    {
        $movies = Movie::select('id', 'name', 'image_link', 'image', 'view_count')
            ->where(function ($query) {
                // $query->where('type', 'like', '%18+%')
                //     ->orWhere('type', 'like', '%21+%')
                //     ->orWhere('type', 'like', '%adult%');
            })
            ->when(request('orderBy'), function ($q) {
                $orderBy = request('orderBy');
                if ($orderBy == 'popular') {
                    $q->orderBy('view_count', 'desc');
                } else if ($orderBy == 'new_arrive') {
                    $q->orderBy('id', 'desc');
                }
            })->when(request('s'), function ($q) {
            $q->where(function ($query1) {
                $query1->where('name', 'like', '%' . request('s') . '%')
                    ->orWhere('actors', 'like', '%' . request('s') . '%')
                    ->orWhere('studio', 'like', '%' . request('s') . '%')
                    ->orWhere('director', 'like', '%' . request('s') . '%')
                    ->orWhere('type', 'like', '%' . request('s') . '%')
                    ->orWhere('description', 'like', '%' . request('s') . '%');
            })
            ;
        })->paginate(20);
        foreach ($movies as $mov) {
            $mov->rating = getMovieRating($mov->id);
            if ($mov->view_count > 1000) {
                $mov->view_count = number_format($mov->view_count / 1000, 1) . 'K';
            }
            $mov->source = 'HL';
        }
        return $movies;
    }

    public function addReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'movie_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        Report::create($request->all());
        return response()->json(['success' => 'Reported'], 200);
    }

    public function checkUpdate($version)
    {
        $currentApp = Application::where('version', $version)->first();
        $lastApp = Application::orderBy('id', 'desc')->get()->first();
        if ($currentApp->id == $lastApp->id) {
            return response()->json(['success' => 'already_update'], 200);
        } else if ($currentApp->id < $lastApp->id) {
            return response()->json(['success' => 'can_get_update', 'application' => $lastApp], 200);
        } else {
            return response()->json(['success' => 'something_was_wrong', 'application' => $lastApp], 200);
        }

    }
}
