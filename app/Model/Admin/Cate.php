<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //数据表
    protected $table = 'category';
    //主键
    protected $primaryKey = 'cate_id';
    //允许操作的字段
    public $guarded = [];
    //是否维护created_at updated_at
    public $timestamps = false;
    //在模型中把数据遍历
    public function getTree()
    {
    	$cates = self::orderby('cate_order','asc')->get();
    	$arr = [];
    	// $arr2 = [];
    	foreach($cates as $v){
    		//找到一级类
    		if($v['cate_pid']==0){
    			$arr[] = $v;
    			//找到二级类
    			foreach($cates as $n){
    				if($n['cate_pid']==$v['cate_id']){
    					//给二级类增加缩进
    					$n['cate_name']='&nbsp;&nbsp;&nbsp;|----'.$n['cate_name'];
    					$arr[] = $n;
    				}
    			}
    		}
    	}
    	return $arr;
    }

    //关联文章表
    public function article()
    {
        return $this->hasMany('App\Model\Admin\Article','cate_id','cate_id');
    }
}
