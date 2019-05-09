<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //数据表
    protected $table = 'user';
    //主键
    protected $primarykey = 'id';
    //可操作字段，设置黑名单
    public $guarded = []; //白名单是fillable
    //created_at 和 updated_at
    public $timestamps = false;
    //关联角色表
    public function role()
    {
    	return $this->belongsToMany('App\Model\Admin\Role','user_role','user_id','role_id');
    }
}
