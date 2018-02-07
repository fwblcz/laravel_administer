<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:m_user|max:50',
            'email' => 'required|email|unique:m_user|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $salt = substr(uniqid(rand()),-6);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => _getSaltHash($request->password,$salt),
            'salt'=>$salt
        ]);
        return redirect()->route('login')->with('success', '注册成功,请登录!');
    }
}
