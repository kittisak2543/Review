<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $role = Auth::user()->role;

        $user = Auth::user();
        if($role == '1'){
            return view('admin/dashboard')->with(compact('user'));
        }
        else{
            return view('profile/show')->with(compact('user'));
        }
           
       
    }
}
