<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $roles = DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
        $users = User::when(request('searchKey'), function ($q) {
            $this->search($q, request('searchKey'));
        })->when(request('filterBy'), function ($q) {
            $q->where('role', request('filterBy'));
        })->paginate(10);
        return view('admin.user.list', compact('users', 'roles'));
    }

    public function editPage($id)
    {
        $user = User::find($id);
        $devices = Session::where('user_id', $id)->get();
        return view('admin.user.edit', compact('user', 'devices'));
    }

    //User Plan Update
    public function plan_change(Request $request, $id)
    {
        $request->validate([
            'planEndDate' => 'required|integer|'
        ]);
        $user = User::find($id);
        $oldDAte =  Carbon::parse($user->plan_end_date);
        $nowDate = Carbon::now();
        $plan_end_date = '';
        if ($oldDAte > $nowDate) {
            $leftMinutes = $oldDAte->diffInMinutes($nowDate);

            $plan_end_date = Carbon::now()->addDay($request->planEndDate)->addMinutes($leftMinutes)->format('Y-m-d h:m:s');
        } else {
            $plan_end_date = Carbon::now()->addDay($request->planEndDate)->format('Y-m-d h:m:s');
        }
        if ($user->role != 'admin') {
            if (strtotime($plan_end_date) > time()) {
                $user->role = 'member';
            } else {
                $user->role = 'user';
            }
        }
        $user->update([
            'plan_end_date' => $plan_end_date,
        ]);
        return back()->with('status', 'Plan Update Successful');
    }

    //User Profile Update
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->password) {
            $request->validate(['password' => 'min:6']);
            $user->password = Hash::make($request->password);
        }
        if ($request->phone) {
            $request->validate(['phone' => 'min:5']);
            $user->phone = $request->phone;
        }
        $user->role = $request->role;
        $user->ctypto_points = $request->coin;
        $user->update();
        return back()->with('status', 'User Updated')->with('success', true);
    }
    public function destroy(Request $request, $id)
    {
        $admin = User::find(Auth::user()->id);
        if (Hash::check($request->password, $admin->password)) {
            $user = User::find($id);
            $user->delete();
            return redirect()->route('admin#user_list')->with('status', $user->name . ' deleted');
        } else {
            return back()->with('status', 'Password is not Correct!Try Again.');
        }
    }

    //Remove Login Devices
    public function rm_device($id)
    {
        Session::where('user_id', $id)->delete();
        return back()->with('status', 'Removed Devices!')->with('success', true);
    }
    private function search($db, $key)
    {
        return $db->where('name', 'like', '%' . $key . '%')
            ->orWhere('email', 'like', '%' . $key . '%')
            ->orWhere('phone', 'like', '%' . $key . '%');
    }
}
