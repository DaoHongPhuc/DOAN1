<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class AdminLoginMiddleware
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
            if($level == 0){ // 0 la admin
                return $next($request);
            }
        }else{
            return redirect('admin/login')->with('thongbao','Đăng nhập không thành công');
        }
    }
}
