<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Login
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
        if(!session('username')){
           return redirect('admin/login')->witherrors('请先登录');
        }     
        return $next($request); 
    }
}
