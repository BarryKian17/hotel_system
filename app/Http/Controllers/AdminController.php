<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //Admin Dashboard
    public function adminDashboard(){
        return view('admin.admin_dashboard');
    }
}
