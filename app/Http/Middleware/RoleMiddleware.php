<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            // المستخدم غير مسجل الدخول
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user->hasRole($role)) {
            
            if ($user->hasRole('client')) {
                return redirect()->route('admin.commandes.index');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('admin.commandes.index');
            } else {
                // إذا ما عندوش أدوار معروفة، يمكن توجهه لـ login أو صفحة خطأ عامة
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
