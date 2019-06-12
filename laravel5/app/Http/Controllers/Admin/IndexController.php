<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台首页
    public function index(){
    	 return view("admin/index");
    }
    //后台欢迎页
    public function welcome(){

    	return view("admin.welcome");
    }
    //后台退出登录
    public function logout(){

    	//清空session中的用户信息
    	session()->flush();
    	return redirect("admin/login");
    }
}
