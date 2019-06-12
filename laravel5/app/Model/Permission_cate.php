<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission_cate extends Model
{
    //关联的数据表
    public $table = "permission_cate";
    //表主键
    public $primaryKey = "id";
    //去除时间戳维护create_at  update_at 字段
    public $timestamps = false;
    //允许批量操作的字段
    public $guarded = [];
}
