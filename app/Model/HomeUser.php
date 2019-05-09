<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeUser extends Model
{
    //数据表
    protected $table = 'homeuser';
    //主键
    protected $primaryKey = 'user_id';
    //允许操作的字段
    public $guarded = [];
    //是否维护created_at updated_at
    public $timestamps = false;
}
