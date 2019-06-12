<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Model\Permission;
use App\Model\Permission_cate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取权限列表
        $permissions = Permission::get();
        $permission_cates = Permission_cate::get();
        return view('admin.permission.index',compact('permissions','permission_cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取权限数据
        $input = $request->input();
        $data['per_name'] = $input['cate_name'];
        $data['cate_id'] = $input['cateid'];
        $data['per_url'] = "admin/".$input['contrller']."/".$input['action'];
        $res = Permission::create($data);
        if($res){
            return redirect("admin/permission")->with("添加成功");
        }else{
            return back()->withInput();
        }
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *  权限分类列表
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cate(){
        //获取权限分类数据
        $per_cates = Permission_cate::orderBy("id",'asc')->paginate(6);
        $counts = Permission_cate::orderBy("id",'asc')->count();
        return view("admin.permission.cate",compact('per_cates','counts'));
    }
    /**
     * Remove the specified resource from storage.
     *  添加权限分类
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCate(Request $request){
        //处理添加分类
        $input = $request->except('_token');
        //验证字段
        $rule = [
            "cate_name" => "required|numeric",
        ];
        $msg = [
            "cate_name.required" => "分类名称不能为空",
            "cate_name.alpha_dash" => "分类名称不符规则",
        ];
        $validator = Validator::make($input,$rule,$msg);
        if($validator->fails()){
            return redirect("admin/permission/cate")->withErrors($validator)->withInput();
        }
        $res = Permission_cate::create($input);
        if($res){
            return redirect("admin/permission/cate")->with("添加成功");
        }else{
            return back()->withInput();
        }
       
    }

}
