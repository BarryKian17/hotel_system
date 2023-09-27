<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //User Profile Page
    public function page(){
        return view('user.dashboard.user_profile');
    }

    //user Profile Update
    public function userProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $this->profileUpdateValidation($request);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address
        ];
        if($request->hasFile('photo')){
            $dbPhoto = User::where('id',$id)->first();
            $dbPhoto = $dbPhoto->photo;
            Storage::delete('public/user_profile/'.$dbPhoto);
            $newPhoto = uniqid() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/user_profile',$newPhoto);
            $data['photo'] = $newPhoto;
        }
        User::where('id',$id)->update($data);

        $noti = array(
            'message'=>'User Profile Update Successfully.',
            'alert-type'=>'success'
        );

        return back()->with($noti);
    }

    //user logout
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $noti = array(
            'message'=>'User Logout Successfully.',
            'alert-type'=>'success'
        );

        return redirect('/login')->with($noti);
    }

    //Change Password Page
    public function userChangePassword(){
        return view('user.dashboard.user_change_password');
    }

    //user Profile Validation
    private function profileUpdateValidation($request){
        $id = Auth::user()->id;
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'phone'=>'unique:users,phone,'.$id,
            'photo'=>'mimes:png,jpg,jpeg,avif'
        ])->validate();
    }
}
