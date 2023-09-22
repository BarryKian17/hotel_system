<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
