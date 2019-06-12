<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\Model\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //用户列表
        //获取请求的参数
        $input = $request->all();
        $users = User::orderBy('id','asc')
        ->where(function($query) use($request){
            $username = $request->input('username');
            if(!empty($username)){
                $query->where('username','like','%'.$username.'%');
            }
        })
        ->paginate($request->input('pagesize')?$request->input('pagesize'):6);
        $counts = User::orderBy('id','asc')
        ->where(function($query) use($request){
            $username = $request->input('username');
            if(!empty($username)){
                $query->where('username','like','%'.$username.'%');
            }
        })->count();
        // $users = User::paginate(2);
        return view("admin.user.list",compact('users','request','counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户
        return view("admin.user.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接收前台表单提交的数据
        $input = $request->except("repass");
        //2.验证表单的数据
        // $url = [
        //     'email' => "required|email",
        //     'username' => "required|alpha_dash|between:5,18",
        //     'pass' => "required|alpha_dash|between:5,18",
        // ];
        // $msg = [
        //     'email.required' => "邮箱必须输入",
        //     'email.email' => "邮箱格式不正确",
        //     'username.required' => "用户名必须输入",
        //     'username.between' => "用户名长度必须5~18位之间",
        //     'username.alpha_dash' => "密码必须是字母数字下划线", 
        //     'password.required' => "密码必须输入",
        //     'password.between' => "密码长度必须在5~18位之间",
        //     'password.alpha_dash' => "密码必须是字母数字下划线", 
        // ];
        // $validator = Validator::make($input,$rule,$msg);
        // if($validator->fails()){
            
        // }
        //3.添加到数据库的user表中
        $input['password'] = Hash::make($request->get('password'));
        $res = User::insert($input);
        if($res){
            $data = [
                'status' => 0,
                'message' => '添加成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '添加失败',
            ];
        }
        //4.添加是否成功，给客户端json格式反馈
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //用户编辑页面
        //获取当前用户数据
        $userinfo = User::find($id);
        return view("admin.user.edit",compact('userinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取要修改的数据
        $user = User::find($id);
        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $res = $user->save();
        if($res){
            $data = [
                'status' => 0,
                'message' => '修改成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '修改失败',
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除用户
        $user = User::find($id);
        $res = $user->delete();
        if($res){
            $data = [
                'status' => 0,
                'message' => '删除成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '删除失败',
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tabStatus(Request $request){
        //获取停用的用户信息
        $user = User::find($request->get('id'));
        $status = $request->get('status');
        $user->status = $status;
        $result = $user->save();
        if($result){
            $data = [
                'status' => 0,
                'message' => $status == 0 ? '停用成功' : '启用成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => $status == 0 ? '停用失败' : '启用失败',
            ];
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     * 批量删除
     * @param  array [] 
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request){
        //获取批量删除id
        $uids = $request->input('uids');
        //执行删除操作
        $res = User::destroy($uids);
        if($res){
            $data = [
                'status' => 0,
                'message' => '批量删除成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '批量删除失败',
            ];
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     * 用户授予角色
     * @param   
     * @return \Illuminate\Http\Response
     */
    public function role(Request $request,$id){
        //获取角色数据
        $roles = DB::table("role")->get();
        //获取之前分配的角色
        $hasRoles = \DB::table('user_role')->where('user_id',$id)->get(); 
        return view("admin.user.role",compact("roles","id","hasRoles"));

    }
    /**
     * Remove the specified resource from storage.
     * 执行授予角色
     * @param   
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request){
        //获取角色数据
        $input = $request->input();
        $user_id = $input['user_id'];
        $role_ids = $input['role_ids'];
        //删除之前的角色
        DB::table('user_role')->where('user_id',$user_id)->delete();
        if(!empty($role_ids)){
            foreach($role_ids as $role_id){
                $res = DB::table("user_role")->insert(['user_id'=>$user_id,'role_id'=>$role_id]);
            }
        }
        if($res){
            $data = [
                'status' => 0,
                'message' => '操作成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => '操作失败',
            ];
        }
        return $data;

    }

}
