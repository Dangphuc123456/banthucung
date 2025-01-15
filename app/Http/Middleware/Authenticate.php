<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra URL để điều hướng đến đúng route login
        if ($request->is('admin/*')) {
            // Điều hướng đến trang login của Admin
            return route('admin.login');
        }

        // Mặc định điều hướng đến trang login của User
        return route('User.userslogin');
    }
}
