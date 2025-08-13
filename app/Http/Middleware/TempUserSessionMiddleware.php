<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TempUserSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('temp_user_id')) {

            $role = Role::firstOrCreate(
                ['id' => 3],
                ['name' => 'temp']
            );

            $tempUser = User::create([
                'name' => 'Temp User',
                'email' => 'temp_' . uniqid() . '@example.com',
                'password' => Hash::make('password'), 
            ]);

            $tempUser->roles()->attach($role->id);

            Session::put('temp_user_id', $tempUser->id);
        }

        return $next($request);
    }
}
