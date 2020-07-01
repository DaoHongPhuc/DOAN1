<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class CustomerMiddleware
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
        if(Auth::check()){
            $user = Auth::user();
            $level = $user->level;
            if($level == 1){ // 1 la customer
                return $next($request);
            }else{
                Auth::logout();
                return redirect('login')->with('thongbao','Đăng nhập bằng tài khoản khách hàng để sử dụng chức năng');
            }
        }else{
            return redirect('login')->with('thongbao','Đăng nhập để sử dụng chức năng');
        }
    }
}
