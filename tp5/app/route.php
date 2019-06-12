<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------

// if (file_exists(CMF_ROOT . "data/conf/route.php")) {
//     $runtimeRoutes = include CMF_ROOT . "data/conf/route.php";
// } else {
//     $runtimeRoutes = [];
// }

// return $runtimeRoutes;

use think\Route;

//路由转换
//api.cmf.com/api/user/index/id/2  ======>   api.cmf.com/user/id/2 
Route::domain('api','api'); 
Route::rule('user/:id','user/index');
Route::post('user','user/login');
//用户上传头像
Route::post('user/icon','user/upload_head_img');
//获取验证码
Route::get('code/:time/:token/:username/:is_exist','code/get_code');
Route::post('user/register','user/register');

