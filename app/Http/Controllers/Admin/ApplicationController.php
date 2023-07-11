<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    public function index()
    {
        $applications = Application::orderBy('id','desc')->get();
        return view('admin.application.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.application.create');
    }

    public function store(Request $request)
    {
        $status = isset($request->status) ? 1 : 0;
        $app = $request->file('application');
        $filename = $app->getClientOriginalName() . '.' . $app->getClientOriginalExtension();
        $app->storeAs('public/application', $filename);

        Application::create([
            'version' => $request->version,
            'key' => $request->key,
            'application' => "/application/" . $filename,
            'status' => $status,
        ]);

        return redirect()->route('application.index')->with('success', 'Create Application Successful');

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        // $app = Application::find($id);
        // return view('admin.application.edit',compact('app'));
    }

    public function update(Request $request, $id)
    {
        return response()->json(['success' => 'success'], 200);
    }

    public function destroy($id)
    {
        Application::find($id)->delete();
        return back()->with('success', 'Delete Application Successful');
    }

    public function chgStatus(Request $request)
    {
        $app = Application::find($request->id);
        $app->status = $app->status ? 0 : 1;
        $app->update();
        $data = $app->status ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
        return response()->json(['success' => $data], 200);
    }
}
