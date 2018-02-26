<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends CommonController
{
    public function index(){
        $users=User::orderBy('uid','desc')->paginate(10);
        return view('user.index',compact('users'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:m_user|max:50',
            'email' => 'required|email|unique:m_user|max:255',
            'password' => 'required|min:6'
        ]);
        $salt = substr(uniqid(rand()),-6);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => _getSaltHash($request->password,$salt),
            'salt'=>$salt
        ]);
        return redirect()->route('users.index')->with('success', '用户添加成功!');
    }

    public function edit(User $user){
        $this->authorize('update',$user);
        $institutions=Institution::all();
        return view('user.edit',compact('user','institutions'));
    }


    public function update(Request $request,User $user){
        $this->authorize('update',$user);
        $this->validate($request,[
            'username' => 'required|unique:m_user|max:50',
            'email' => 'required|email|unique:m_user|max:255',
        ]);
        $data=$request->all();
        $user->update($data);
        return redirect()->route('users.index')->with('success','用户更新成功!');
    }

    public function destroy(User $user){
        $this->authorize('destroy', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success','用户删除成功!');
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }

   
}
