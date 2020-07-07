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
            if($level == 1 || $level == 0){ // 1 la customer
                return $next($request);
            }else{
                return redirect()->back()->with('thongbao','Cần tài khoản Khách Hàng để sử dụng chức năng');
            }
        }else{
            return redirect('login')->with('thongbao','Đăng nhập để sử dụng chức năng');
        }
    }
}
