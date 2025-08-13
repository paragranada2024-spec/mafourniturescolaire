<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CleanupTempUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if session is expired or user is gone
        if (!Session::has('temp_user_id') && Session::previousHas('temp_user_id')) {
            $tempUserId = Session::previous('temp_user_id');

            $user = User::find($tempUserId);

            if ($user && $user->email && str_starts_with($user->email, 'temp_')) {
                $user->delete();
            }
        }

        return $next($request);
    }
}
