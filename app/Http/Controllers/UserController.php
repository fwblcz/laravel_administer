<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends CommonController
{
    public function dashboard(){
        $user=Auth::user();
        $user->c_time=date('Y-m-d H:i:s',$user->c_time);
        return view('home.index',compact('user'));
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
