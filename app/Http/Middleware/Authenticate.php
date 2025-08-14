<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $response = $next($request);
    
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
    
}
