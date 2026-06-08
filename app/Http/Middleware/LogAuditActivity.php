<?php

namespace App\Http\Middleware;

use App\Services\AuditService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAuditActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);

            // Logger les connexions réussies
            if ($request->routeIs('login') && $request->isMethod('post')) {
                if ($response->status() === 302 || $response->status() === 301) {
                    if (auth()->check()) {
                        AuditService::logLogin($request->input('email', ''), true);
                    }
                }
            }

            // Logger les déconnexions
            if ($request->routeIs('logout') && $request->isMethod('post')) {
                AuditService::logLogout();
            }

            return $response;
        } catch (\Exception $e) {
            \Log::error('LogAuditActivity middleware error: ' . $e->getMessage());
            return $next($request);
        }
    }
}
