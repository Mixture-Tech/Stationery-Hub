<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập để truy cập.');
        }

        if (Auth::user()->id_role !== 1) {
            return redirect('/dashboard')->with('error', 'Bạn không có quyền truy cập khu vực này.');
        }

        return $next($request);
    }
}