<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        } else {
            $error = 'Vui lòng đăng nhâp!';
            return redirect("dang-nhap/$error");
        }
    }
}
