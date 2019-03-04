<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        if(!session('userInfo')) {
            return redirect("/admin/login")->with('alertMsg','客官，请先登录!');
        }
        return $next($request);
    }
}
