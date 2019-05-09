<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //数据表
    protected $table = 'permission';
    //主键
    protected $primarykey = 'id';
    //允许操作的字段
    public $guarded = [];
    //是否维护created_at updated_at
    public $timestamps = false;
}
