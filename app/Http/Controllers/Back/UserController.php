<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::paginate(3);
        $users->setPath(url('/admin/user'));
        return view('back.user.index',compact('users'));
    }

    public function lock($id){
        $user = User::findOrFail($id);
        $user->is_locked = true;
        $user->save();

        Session::flash('flash_message', "用户".$user->name."锁定成功");

        return \Redirect::back();
    }
    public function unlock($id){
        $user = User::findOrFail($id);
        $user->is_locked = false;
        $user->save();
        Session::flash('flash_message', "用户".$user->name."解除锁定成功");

        return \Redirect::back();
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('flash_message', "用户".$user->name."删除成功");

        return \Redirect::back();
    }
    public function deladmin($id){
        $user = User::findOrFail($id);
        $user->is_admin = false;
        $user->save();
        Session::flash('flash_message', "用户".$user->name."退出管理员成功");

        return \Redirect::back();
    }
    public function add2admin($id){
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();
        Session::flash('flash_message', "用户".$user->name."加入管理员成功");

        return \Redirect::back();
    }
    public function delreception($id){
        $user = User::findOrFail($id);
        $user->is_reception = false;
        $user->save();
        Session::flash('flash_message', "用户".$user->name."退出前台成功");

        return \Redirect::back();
    }
    public function add2reception($id){
        $user = User::findOrFail($id);
        $user->is_reception = true;
        $user->save();
        Session::flash('flash_message', "用户".$user->name."加入前台成功");

        return \Redirect::back();
    }

}
