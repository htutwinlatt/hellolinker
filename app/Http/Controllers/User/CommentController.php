<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($movId)
    {

        $comments = Comment::where('movie_id',$movId)->orderBy('id','desc')->paginate(10);
        $movie = Movie::select('name','id')->find($movId);
        return view('user.comments',compact('comments','movie'));
    }

    public function add(Request $request,$movId)
    {
        $this->cmtValidate($request);
        Comment::create($this->cmtSave($request,$movId));
        // return response()->json(['success'=>'<span language="eng">Submited Comment</span><span language="mm">မှတ်ချက်ပေးပြီးပါပြီ</span>']);
        return response()->json(['success'=>['mm'=>'မှတ်ချက်ပေးပြီးပါပြီ','eng'=>'Submited Comment']]);

    }

    //Delete Comment
    public function destroy($id){
        Comment::find($id)->delete();
        // return back()->with('success','<span language="eng">Deleted Comment</span><span language="mm">မှတ်ချက်အားဖယ်ရှားပြီးပါပြီ</span>');
        return response()->json(['success'=>['mm'=>'မှတ်ချက်အားဖယ်ရှားပြီးပါပြီ','eng'=>'Deleted Comment']]);
    }

    //Get Comment Preview
    public function get_comments_preview($id)
    {
        $totalCmt = Comment::where('movie_id',$id)->count();
        $comments = Comment::select('comments.*','users.name','users.profile_photo_path')
        ->join('users','users.id','comments.user_id')->where('comments.movie_id',$id)
                    ->orderBy('comments.id','desc')->limit(3)->get();
        return view('user.loadCompoment.previewCmt',compact('comments','totalCmt','id'));
    }

    private function cmtValidate($req){
        $req->validate([
            'comment'=>'required|min:5',
            'rating'=>'required'
        ]);
    }


    private function cmtSave($request,$movId){
        return [
            'comment'=>$request->comment,
            'rating' => $request->rating,
            'user_id' => Auth::user()->id,
            'movie_id' => $movId,
        ];
    }
}
