<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Admin Dashboard
    public function adminDashboard(){
        return view('admin.index');
    }

    //admin logout
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    //Admin Login page
    public function adminLogin(){
        return view('admin.admin_login');
    }

    //Admin Profile Page
    public function adminProfile(){
        return view('admin.admin_profile');
    }

    //Admin Profile Update
    public function adminProfileUpdate(Request $request){
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
            Storage::delete('public/profile/'.$dbPhoto);
            $newPhoto = uniqid() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/profile',$newPhoto);
            $data['photo'] = $newPhoto;
        }
        User::where('id',$id)->update($data);

        $noti = array(
            'message'=>'Admin Profile Update Successfully.',
            'alert-type'=>'success'
        );

        return back()->with($noti);
    }

    //Admin Change Password
    public function adminChangePassword(){
        return view('admin.admin_changePassword');
    }

    //Admin Profile Validation
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
