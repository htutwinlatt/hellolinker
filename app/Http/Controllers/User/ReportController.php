<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type'=>'required',
            'movieId'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        Report::create([
            'type'=>$request->type,
            'remark'=>$request->remark,
            'movie_id'=>$request->movieId,
        ]);

        return response()->json(['success'=>'Reported.'], 200);

    }
}
