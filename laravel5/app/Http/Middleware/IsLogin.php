<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
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
        if(session()->get('username')){
            
            return $next($request);
        }else{
            echo "hello world";
            return redirect("admin/login")->with('errors',"你未登录，请先登录！~~");
        }
        
    }
}
