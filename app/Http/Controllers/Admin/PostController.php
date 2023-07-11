<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.post.index');
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.post.edit',compact('id'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
