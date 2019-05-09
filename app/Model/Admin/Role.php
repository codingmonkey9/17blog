<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //数据表
    protected $table = 'role';
    //主键
    protected $primarykey = 'id';
    //允许操作的字段
    public $guarded = [];
    //是否需要created_at updated_at
    public $timestamps = false;
    //关联权限表
    public function permission()
    {
    	return $this->belongsToMany('App\Model\Admin\Permission','role_permission','role_id','permission_id');
    }
}
