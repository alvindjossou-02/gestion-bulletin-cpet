<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
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

            // Logger les connexions
            if ($request->routeIs('login') && $request->isMethod('post')) {
                \Log::info('Login attempt detected', [
                    'response_status' => $response->status(),
                    'is_authenticated' => auth()->check(),
                    'route' => $request->route()?->getName(),
                ]);
                
                if ($response->status() === 302 || $response->status() === 301) {
                    $this->logLogin($request);
                }
            }

            // Logger les déconnexions
            if ($request->routeIs('logout') && $request->isMethod('post')) {
                $this->logLogout();
            }

            return $response;
        } catch (\Exception $e) {
            \Log::error('LogAuditActivity middleware error: ' . $e->getMessage());
            // Continuer malgré l'erreur de logging
            return $next($request);
        }
    }

    /**
     * Logger une connexion
     */
    private function logLogin(Request $request)
    {
        try {
            // Attendre que l'utilisateur soit authentifié
            if (auth()->check()) {
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'login',
                    'model' => 'User',
                    'model_id' => auth()->id(),
                    'old_values' => null,
                    'new_values' => null,
                    'ip_address' => $request->ip() ?? '0.0.0.0',
                    'user_agent' => $request->userAgent() ?? null,
                    'description' => auth()->user()->name . ' s\'est connecté',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Login audit log error: ' . $e->getMessage());
        }
    }

    /**
     * Logger une déconnexion
     */
    private function logLogout()
    {
        try {
            if (auth()->check()) {
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'logout',
                    'model' => 'User',
                    'model_id' => auth()->id(),
                    'old_values' => null,
                    'new_values' => null,
                    'ip_address' => request()->ip() ?? '0.0.0.0',
                    'user_agent' => request()->userAgent() ?? null,
                    'description' => auth()->user()->name . ' s\'est déconnecté',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Logout audit log error: ' . $e->getMessage());
        }
    }
}
