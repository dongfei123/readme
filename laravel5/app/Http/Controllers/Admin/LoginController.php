<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
use Hash;

class LoginController extends Controller
{
    public function login(){

    	return view("admin/login");
    }
    //生成验证吗
    public function code(){

    	$code = new Code();
    	return $code->make();
    }
    //处理用户登录
    public function doLogin(request $request){
    	//接收表单数据
    	$input = $request->except('_token');
    	//1.验证码验证
    	if(strtolower($request->get('code')) != strtolower(\Session::get('code'))){
    		return redirect("admin/login")->with('errors',"验证码错误")->withInput();
    	}
    	//2.进行表单验证
    	$rule = [
    		'username' => 'required|between:4,18',
    		'password' => 'required|between:4,18|alpha_dash',
    	];
    	//验证错误信息
    	$msg = [
    		'username.required' => "用户名必须输入",
    		'username.between' => "用户名长度必须4~18位之间",
    		'password.required' => "密码必须输入",
    		'password.between' => "密码长度必须在4~18位之间",
    		'password.alpha_dash' => "密码必须是字母数字下划线", 
    	];
    	$validator = Validator::make($input,$rule,$msg);
    	if($validator->fails()){
    		return redirect('admin/login')->withErrors($validator)->withInput();
    	}
    	$user = User::where('username',$input['username'])->first();
    	if(!$user){
    		return redirect("admin/login")->with('errors',"用户名为空")->withInput();
    	}
    	//验证加密密码
    	// $pwd = Hash::make($input['password']);
    	//检测密码是否一致
    	$res = Hash::check($request->get('password'),$user['password']);
    	if($res){
    		//把用户数据存储到session中
    		session()->put('username',$request->get('username'));
    		return redirect("admin/index");
    	}else{
    		return redirect("admin/login")->with("errors","密码错误")->withInput();
    	}


    }
}
