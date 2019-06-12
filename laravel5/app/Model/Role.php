<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //关联的数据表
    public $table = "role";
    //表主键
    public $primaryKey = "id";
    //时间戳维护create_at  update_at 字段
    public $timestamps = false;
    //允许批量操作的字段
    public $guarded = [];
}
