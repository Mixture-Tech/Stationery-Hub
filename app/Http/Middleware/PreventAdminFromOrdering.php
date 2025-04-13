<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAdminFromOrdering
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->id_role === 1) {
            return redirect('/dashboard')->with('error', 'Tài khoản ADMIN không được phép đặt hàng.');
        }

        return $next($request);
    }
}