<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	//后台登录页面
	Route::get('login',"LoginController@login");
	//验证吗路由
	Route::get('code',"LoginController@code");
	//处理登录的方法
	Route::post('doLogin',"LoginController@doLogin");
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'islogin'],function(){
	Route::get('index',"IndexController@index");
	//后台欢迎页面
	Route::get('welcome',"IndexController@welcome");
	Route::get('logout',"IndexController@logout");
	//用户模块
	Route::post('user/tabStatus',"UserController@tabStatus");
	//用户授予角色
	Route::get('user/role/{id}',"UserController@role");
	Route::post('user/addRole',"UserController@addRole");
	//批量删除
	Route::post('user/del',"UserController@del");
	//用户模块资源路由
	Route::resource('user',"UserController");
	//角色模块
	//批量删除角色
	Route::post('role/del',"RoleController@del");
	Route::get('role/auth/{id}',"RoleController@auth");
	Route::resource('role',"RoleController");
	//权限模块
	Route::get('permission/cate',"PermissionController@cate");
	Route::post('permission/addCate',"PermissionController@addCate");
	Route::resource('permission',"PermissionController");
});
