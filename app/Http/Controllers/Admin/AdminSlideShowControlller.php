<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSlideShowControlller extends Controller
{
    public function index()
    {
        $slideShows = SlideShow::orderBy('id', 'asc')->get();
        foreach ($slideShows as $key => $s) {
            $s = SlideShow::find($s->id);
            $s->update([
                'id' => $key + 1,
            ]);
        }
        $slideShows = SlideShow::all();
        return view('admin.slideshow.list', compact('slideShows'));
    }

    //Insert Page Slideshow
    public function insertPage()
    {
        $autoFill = [];
        if (request('selectMovie')) {
            $autoFill = Movie::select('name', 'description', 'id', 'image_link')->find(request('selectMovie'));
            $autoFill->link = route('user#movie_info', $autoFill->id);
        }
        return view('admin.slideshow.add', compact('autoFill'));
    }

    //Insert Slideshow to database
    public function insert(Request $request)
    {
        $this->SlideshowValidation($request, 'insert');
        SlideShow::create($this->SaveSlideshow($request, null));
        return redirect()->route('admin#slideshow_list')->with('status', 'Slideshow add successful');
    }

    //Edit Page
    public function editPage($id)
    {
        $slide = SlideShow::find($id);
        return view('admin.slideshow.edit', compact('slide'));
    }

    //Update Slideshow
    public function update(Request $request, $id)
    {
        $request->id = $id;
        $this->SlideshowValidation($request, 'update');
        $slide = SlideShow::find($id);
        $slide->update($this->SaveSlideshow($request, $slide));
        $back = route('admin#slideshow_edit', $slide->id);
        return redirect()->to($back . '?view=true')->with('status', 'Update Successful');
    }
    //Delete Slideshow
    public function destroy($id)
    {
        $slide = SlideShow::find($id);
        $this->SlideShowImgDel($slide->image);
        $slide->delete();
        return redirect()->route('admin#slideshow_list')->with('status', 'Deleted (' . $slide->title . ') succeed!');
    }

    //Search Movie
    public function searchMovie()
    {
        $key = request('searchKey');
        $movies = [''];
        if (strlen($key) > 0) {
            $movies = Movie::select('name', 'id')->Where('name', 'like', '%' . $key . '%')
                ->orWhere('actors', 'like', '%' . $key . '%')
                ->orWhere('studio', 'like', '%' . $key . '%')
                ->orWhere('director', 'like', '%' . $key . '%')
                ->orWhere('type', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%')->get();
        }
        return response()->json($movies);
    }

    //Sort By

    public function sort(Request $request)
    {
        $moveSlideShow = SlideShow::find($request->sid);
        $moveSlideShow->update([
            'id' => 1000,
        ]);
        if ($request->position < $request->sid) {
            $chgSlideshows = SlideShow::where('id', '>=', $request->position)->where('id', '<',$request->sid)
                ->orderBy('id', 'desc')->get();
            foreach ($chgSlideshows as $key => $slide) {
                $dbSlide = SlideShow::find($slide->id);
                $dbSlide->update([
                    'id' => $slide->id + 1,
                ]);
            }
        } else {
            $chgSlideshows = SlideShow::where('id','<=',$request->position)->where('id','>',$request->sid)->orderBy('id','asc')->get();
            foreach ($chgSlideshows as $key => $slide) {
                $dbSlide = SlideShow::find($slide->id);
                $dbSlide->update([
                    'id' => $slide->id - 1,
                ]);
            }
        };
        $moveSlideShow = SlideShow::find(1000);
        $moveSlideShow->update([
            'id' => $request->position,
        ]);
        $slideShows = SlideShow::all();
        $data = '';
        return response()->json($slideShows, 200);

    }

    private function SlideshowValidation($request, $mode)
    {
        if ($mode == 'insert') {
            $request->validate([
                // 'image' => 'required',
            ]);
        }
        if ($mode == 'update') {
            $request->validate([
                'eid' => 'required|unique:slide_shows,id,' . $request->id,
            ]);
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'link' => 'required',
        ]);
    }

    private function SaveSlideshow($request, $db)
    {
        $action = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image_link' => $request->imageLink,
        ];
        if ($db) {
            $action['id'] = $request->eid;
        }
        if ($request->hasFile('image')) {
            if ($db) {
                $this->SlideShowImgDel($db->image);
            }
            $image = uniqid() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/slideShows/', $image);
            $action['image'] = $image;
            $action['image_link'] = null;
        } else if ($request->imageLink != '') {
            if ($db) {
                $this->SlideShowImgDel($db->image);
            }
            $action['image'] = null;
        }
        return $action;
    }

    private function SlideShowImgDel($image)
    {
        $path = 'storage/slideShows/' . $image;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
