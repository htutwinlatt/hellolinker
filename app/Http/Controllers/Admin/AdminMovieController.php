<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\AssignOp\Mod;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::when(request('searchKey'), function ($q) {
            Movie::search($q, request('searchKey'));
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin.movie.list', compact('movies'));
    }

    public function insertPage()
    {
        return view('admin.movie.add');
    }

    //Delete Movie
    public function destroy($id)
    {
        $movie = Movie::find($id)->delete();
        return back()->with('success', 'Delete Movie Successful');
    }

    public function new_arrives()
    {
        $movies = Movie::where('new_arrived', '1')->when(request('searchKey'), function ($q) {
            Movie::search($q, request('searchKey'));
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin.movie.new_arrives', compact('movies'));
    }
    public function insert(Request $request)
    {
        $request->validate($this->MovieValidator('create'));
        Movie::create($this->saveMovie($request, Null));
        return redirect()->route('admin#movie_list')->with('success', 'Create Movie Successful');
    }

    public function editPage($id)
    {
        $comment_count = Comment::where('movie_id')->count();
        $movie = Movie::find($id);
        return view('admin.movie.edit', compact('movie','comment_count'));
    }
    //Update Movie
    public function edit($id, Request $request)
    {
        $request->validate($this->movieValidator('update'));
        $movie = Movie::find($id);
        $movie->update($this->saveMovie($request, $movie));
        return redirect()->to($request->back_url)->with('status', 'Movie Update Successful');
    }
    //New Arrive Remove
    public function new_arr_remove($id)
    {
        $movie = Movie::find($id);
        $movie->update([
            'new_arrived'=>0
        ]);
        return back()->with('status','Remove Form New Arrived.');
    }

    private function saveMovie($request, $db)
    {
        $action = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->movieLink,
            'episodes'=>$request->movieEpisode,
            'trailer' => $request->movieTrailer,
            'actors' => $request->actors,
            'studio' => $request->studio,
            'director' => $request->director,
            'type' => $request->type,
            'role' => $request->role,
            'new_arrived' => $request->newArrive ? '1' : '0',
            'released_at' => $request->releasedDate,
            'image_link' => $request->imageLink,
        ];
        if ($request->hasFile('image')) {
            if ($db) {
                $this->movieImageDel($db->image);
            }
            $image = uniqid() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/movie_photos', $image);
            $action['image'] = $image;
            $action['image_link']==NULL;
        }else if($request->imageLink != ''){
            if ($db) {
                $this->movieImageDel($db->image);
            }
            $action['image'] = NULL;
            $action['image'] = NULL;
        }
        return $action;
    }

    private function movieValidator($type)
    {
        $action = [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            // 'movieLink' => 'required',
            'movieTrailer' => 'required',
            'type' => 'required',
            'role' => 'required',
            'description' => 'required'
        ];
        $type == 'create' ? $action['image'] = 'image|mimes:jpeg,png,jpg,gif' : false;
        return $action;
    }

    private function movieImageDel($filename)
    {
        $path = 'storage/movie_photos/' . $filename;
        if (File::exists($path)) {
            File::delete($path);
        };
    }
}
