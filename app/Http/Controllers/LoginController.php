<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['username'=>$request->username,'password'=>$request->password])){
            return redirect()->route('users.index');
        }else{
            return redirect()->back()->with('danger','用户名或者密码错误!');
        }
    }
}
