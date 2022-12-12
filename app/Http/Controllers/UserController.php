<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Image;

class UserController extends Controller
{
    function userlist(){
         $users = User::where('id','!=', Auth::id())->get(); 
        return view('admin.user.user_list',[
            'users'=>$users,
        ]);
    }
    function delete_user($user_id){
        User::find($user_id)->delete();
        return back();
    }
    function edit_profile(){
        return view('admin.user.edit_profile');
    }
    function update_name(Request $request){
        User::find(Auth::id())->update([
            'name'=>$request->name,
        ]);
        return back()->with('name_success', 'Name has been Updated!!');
    }
    function update_password(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>['required','confirmed',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'password_confirmation'=>'required',
        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
            user::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('pass_success', 'Password has been Updated!!');
        }
        else{
            return back()->with('wrong', 'Old password Doesnot Match');
        }
    }
    function add_profile_photo(Request $request){
        $profile_photo = $request->profile_photo;
        if(Auth::user()->profile_photo !=null){
            $extension = $profile_photo->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            $img = Image::make($profile_photo)->save(public_path('uploads/profile/'.$file_name));
            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
            ]);
            return back();
        }
        else{
            $extension = $profile_photo->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            $img = Image::make($profile_photo)->save(public_path('uploads/profile/'.$file_name));
            User::find(Auth::id())->update([
                'profile_photo'=>$file_name,
            ]);
            return back();
        }

    }
}
