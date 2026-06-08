<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditAllRequests
{
    /**
     * Handle an incoming request.
     * Ce middleware est très minimaliste pour éviter les boucles infinies.
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
