<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Rule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //在登录的时候吧权限查询出来，放在session中，可以避免每次访问页面都要查询数据库的问题
        //获取用户的访问的url
        $route = \Route::current()->getActionName();
        //从session中获取该用户的权限
        $per = session()->get('rule');
        if(in_array($route,$per)){
            return $next($request);
        }else{
            return redirect('admin/noaccess');
        }
    }
}
