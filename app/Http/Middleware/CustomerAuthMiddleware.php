<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is not authenticated  
        if (!Auth::guard('customer')->check()) {
            return $next($request);
        }
        return redirect()->route('User.home')->with('error', 'Vui lòng đăng nhập!');
    }
}
