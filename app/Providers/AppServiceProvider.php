<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Admin\Cate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cates = Cate::all();
        //遍历分类
        foreach($cates as $k=>$v){
            //先获取一级类
            if($v['cate_pid']==0){
                $cateone[$k] = $v;
                foreach($cates as $m=>$n){
                    if($n['cate_pid']==$v['cate_id']){
                        $catetwo[$k][$m] = $n;
                    }
                }
            }
        }
        //变量共享
        view()->share('cateone',$cateone);
        view()->share('catetwo',$catetwo);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
