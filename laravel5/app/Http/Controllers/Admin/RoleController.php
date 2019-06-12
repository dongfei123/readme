<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //角色列表页
        //获取角色数据并进行分页
        $input = $request->all();
        $roles = Role::orderBy("id",'asc')
                 ->where(function($query) use($request){
                    $rolename = $request->input('rolename');
                    $start = $request->input('start');
                    $end = $request->input('end');
                    if(!empty($rolename)){
                        $query->where("role_name",'like','%'.$rolename.'%');
                    }
                    if(!empty($start) && !empty($end)){
                        $query->where("create_at",'between',$start,'and',$end);
                    }
                 })
                 ->paginate(6);
        $counts = Role::orderBy("id",'asc')
                 ->where(function($query) use($request){
                    $rolename = $request->input('rolename');
                    $start = $request->input('start');
                    $end = $request->input('end');
                    if(!empty($rolename)){
                        $query->where("role_name",'like','%'.$rolename.'%');
                    }
                    if(!empty($start) && !empty($end)){
                        $query->where("create_at",'between',$start,'and',$end);
                    }
                 })
                 ->count();
        return view("admin.role.index",compact('roles','counts','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //角色添加页面
        return view("admin.role.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取添加数据
        $input['role_name'] = $request->input('role_name');
        $input['create_at'] = date("Y-m-d H:i:s");
        $input['update_at'] = date("Y-m-d H:i:s");
        $res = Role::create($input);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取当前记录数据
        $role = Role::find($id);
        $res = $role->delete();
        if($res){
            $data = [
                'status' => 0,
                'message' => "删除成功",
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => "删除失败",
            ];
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *  批量删除角色
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request){
        //批量删除数据
        $ids = $request->input('ids');
        $res = Role::destroy($ids);
        //执行删除操作
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
     * 角色授权
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auth($id){
        //授权角色数据
        $role = Role::find($id);
        $rolename = $role->role_name;
        return view("admin.role.auth",compact('rolename'));
    }


}
