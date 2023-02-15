<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.show');
    }

    public function update_profile(Request $request)
    {
        $validator = $this->updateValidator($request);
        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()->all()]);
        }
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('profileImage')) {
            $path = 'storage/profile_photos/'.$user->profile_photo_path;
            $this->deleteImage($path);
            $image = uniqid().'-'.time().'.'.$request->file('profileImage')->getClientOriginalExtension();
            $request->file('profileImage')->storeAs('public/profile_photos',$image);
            $user->profile_photo_path = $image;
        }
        $user->update($this->updateProfile($request));
        return response()->json(['success'=> "Profile Update Successfully!Please Refresh Page."]);
    }

    public function update_password(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->password,$user->password)) {
            return response()->json(['errors'=>['The old password you have enter is incorrect!']]);
        }
        $validator = $this->passwordValidator($request);
        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()->all()]);
        }
        if (Hash::check($request->newPassword,$user->password)) {
            return response()->json(['errors'=>['Your new password cannot be same as your current password!']]);
        }

        $user->update([
            'password'=> Hash::make($request->newPassword)
        ]);
        Auth::logout();
        return response()->json(['success'=>'Password Update Successful!.Please Login Again','refresh'=>true]);
    }

    private function updateProfile($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'gender'=>$req->gender,
        ];
    }
    private function updateValidator($request){
        return Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'gender'=>'required',
            'profileImage'=>'image',
        ]);
    }
    private function passwordValidator($request){
        return Validator::make($request->all(),[
            'password'=>'required',
            'newPassword'=>'required',
            'newConfirmPassword'=>'required|same:newPassword'
        ]);
    }
    private function deleteImage($path){
        if (File::exists($path)) {
            File::delete($path);
        }
    }


}
