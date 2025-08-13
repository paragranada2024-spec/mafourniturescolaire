<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/dashboard');
        }

        /** @var User $user */
        $user = Auth::user();

        if (!$user->hasRole($role)) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
