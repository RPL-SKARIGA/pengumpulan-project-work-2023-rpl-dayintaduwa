<?php

namespace App\Http\Middleware;

use Closure;

class PreventBackButtonMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        return $response->header('Cache-Control','no-cache,no-store, max-age=0, must-revalidate')
        ->header('Pragma','no-cache')
        ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
        // $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        // $response->headers->set('Pragma', 'no-cache');
        // $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        // return $response;
    }
}
