<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //数据表
    protected $table = 'comment';
    //主键
    protected $primaryKey = 'id';
    //允许操作的字段
    public $guarded = [];
    //是否维护created_at updated_at
    public $timestamps = false;
}
