<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // Đăng nhập thất bại thì chuyển hướng đến admin.login
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login');
    }
    protected function authenticate($request, array $guards)
    {
        // Check thông qua file config\auth xem người dùng có quyền admin không
        // Nếu không sẽ chuyển hướng  
        if ($this->auth->guard('admin')->check()) {
            return $this->auth->shouldUse('admin');
        }

        $this->unauthenticated($request, ['admin']);
    }
}
