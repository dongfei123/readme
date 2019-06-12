<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //关联的数据表
    public $table = "user";
    //表主键
    public $primaryKey = "id";
    //去除时间戳维护
    public $timestamps = false;
    public $guarded = [];
}
