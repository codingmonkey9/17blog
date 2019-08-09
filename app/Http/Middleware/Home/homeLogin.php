<?php

namespace App\Http\Middleware\Home;

use Closure;
use Log;

class homeLogin
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
        
        Log::info('这是在home中间件里的日志');
        if(session('homeuser')){
            return $next($request);
        }else{
            return redirect('/home/login');
        }
    }
}
