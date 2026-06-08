<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Arr;

class AuditService
{
    /**
     * Logger une action CRUD
     */
    public static function logModelAction(
        string $action,
        string $model,
        ?int $modelId = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $description = null
    ): AuditLog {
        $severity = self::getSeverity($action);
        
        return self::createLog([
            'user_id' => auth()->id(),
            'user_role' => auth()->user()?->role ?? 'guest',
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'old_values' => $oldValues ? self::sanitizeValues($oldValues) : null,
            'new_values' => $newValues ? self::sanitizeValues($newValues) : null,
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'method' => request()->method() ?? 'CLI',
            'route' => request()->route()?->getName() ?? null,
            'url' => request()->url() ?? null,
            'description' => $description ?? self::generateModelDescription($action, $model, $modelId),
            'severity' => $severity,
        ]);
    }

    /**
     * Logger une connexion
     */
    public static function logLogin(string $email, bool $success = true): AuditLog
    {
        if ($success) {
            return self::createLog([
                'user_id' => auth()->id(),
                'user_role' => auth()->user()?->role ?? 'unknown',
                'action' => 'login',
                'model' => 'User',
                'model_id' => auth()->id(),
                'ip_address' => request()->ip() ?? '0.0.0.0',
                'user_agent' => request()->userAgent() ?? null,
                'method' => 'POST',
                'route' => 'login',
                'url' => request()->url() ?? null,
                'description' => auth()->user()->name . ' s\'est connecté',
                'severity' => 'info',
                'response_status' => 200,
            ]);
        } else {
            return self::createLog([
                'user_id' => null,
                'user_role' => 'guest',
                'action' => 'failed_login',
                'model' => 'User',
                'model_id' => null,
                'ip_address' => request()->ip() ?? '0.0.0.0',
                'user_agent' => request()->userAgent() ?? null,
                'method' => 'POST',
                'route' => 'login',
                'url' => request()->url() ?? null,
                'request_data' => ['email' => $email],
                'description' => 'Tentative de connexion échouée - ' . $email,
                'severity' => 'warning',
                'response_status' => 401,
            ]);
        }
    }

    /**
     * Logger une déconnexion
     */
    public static function logLogout(): ?AuditLog
    {
        $user = auth()->user();
        if (!$user) return null;

        return self::createLog([
            'user_id' => $user->id,
            'user_role' => $user->role ?? 'unknown',
            'action' => 'logout',
            'model' => 'User',
            'model_id' => $user->id,
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'method' => 'POST',
            'route' => 'logout',
            'url' => request()->url() ?? null,
            'description' => $user->name . ' s\'est déconnecté',
            'severity' => 'info',
            'response_status' => 200,
        ]);
    }

    /**
     * Logger une tentative d'accès non autorisé
     */
    public static function logUnauthorized(string $reason = 'Permission denied'): AuditLog
    {
        return self::createLog([
            'user_id' => auth()->id(),
            'user_role' => auth()->user()?->role ?? 'guest',
            'action' => 'unauthorized',
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'method' => request()->method(),
            'route' => request()->route()?->getName() ?? null,
            'url' => request()->url() ?? null,
            'description' => 'Accès non autorisé - ' . $reason . ' (' . request()->path() . ')',
            'severity' => 'warning',
            'response_status' => 403,
        ]);
    }

    /**
     * Logger une erreur
     */
    public static function logError(\Throwable $exception, string $context = ''): AuditLog
    {
        return self::createLog([
            'user_id' => auth()->id(),
            'user_role' => auth()->user()?->role ?? 'guest',
            'action' => 'error',
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'method' => request()->method() ?? 'CLI',
            'route' => request()->route()?->getName() ?? null,
            'url' => request()->url() ?? null,
            'description' => class_basename($exception) . ': ' . $exception->getMessage() . ($context ? ' [' . $context . ']' : ''),
            'severity' => 'error',
            'response_status' => 500,
        ]);
    }

    /**
     * Logger une action de fichier
     */
    public static function logFileAction(string $action, string $filename, ?string $description = null): AuditLog
    {
        return self::createLog([
            'user_id' => auth()->id(),
            'user_role' => auth()->user()?->role ?? 'guest',
            'action' => $action,
            'model' => 'File',
            'model_id' => null,
            'url' => request()->url() ?? null,
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'description' => $description ?? ucfirst($action) . ' du fichier: ' . $filename,
            'severity' => 'info',
        ]);
    }

    /**
     * Logger un export de données
     */
    public static function logExport(string $type, int $recordCount, ?string $description = null): AuditLog
    {
        return self::createLog([
            'user_id' => auth()->id(),
            'user_role' => auth()->user()?->role ?? 'guest',
            'action' => 'export',
            'model' => $type,
            'route' => request()->route()?->getName() ?? null,
            'url' => request()->url() ?? null,
            'request_data' => ['record_count' => $recordCount],
            'ip_address' => request()->ip() ?? '0.0.0.0',
            'user_agent' => request()->userAgent() ?? null,
            'description' => $description ?? 'Export de ' . $recordCount . ' enregistrements (' . $type . ')',
            'severity' => 'info',
        ]);
    }

    /**
     * Créer un log d'audit
     */
    protected static function createLog(array $data): AuditLog
    {
        try {
            // Nettoyer les valeurs null
            $data = array_filter($data, fn($v) => $v !== null && $v !== '');
            
            return AuditLog::create($data);
        } catch (\Exception $e) {
            \Log::error('Erreur création audit log: ' . $e->getMessage());
            // Retourner un modèle vide pour éviter les erreurs
            return new AuditLog($data);
        }
    }

    /**
     * Nettoyer les valeurs sensibles
     */
    protected static function sanitizeValues(array $values): array
    {
        return Arr::except($values, [
            'password', 'password_confirmation', 'remember_token',
            'email_verified_at', 'secret', 'token', 'api_token'
        ]);
    }

    /**
     * Nettoyer les données de requête
     */
    protected static function sanitizeRequestData(array $data): array
    {
        $excluded = ['password', 'password_confirmation', 'remember_token', '_token', '_method', 'secret'];
        $sanitized = Arr::except($data, $excluded);
        
        // Limiter à 50 clés
        return array_slice($sanitized, 0, 50);
    }

    /**
     * Déterminer la sévérité basée sur l'action
     */
    protected static function getSeverity(string $action): string
    {
        return match ($action) {
            'create', 'update', 'delete' => 'info',
            'unauthorized' => 'warning',
            'error', 'failed_login' => 'error',
            default => 'info',
        };
    }

    /**
     * Générer une description pour les actions CRUD
     */
    protected static function generateModelDescription(string $action, string $model, ?int $modelId): string
    {
        $descriptions = [
            'create' => 'Création',
            'update' => 'Modification',
            'delete' => 'Suppression',
            'restore' => 'Restauration',
        ];

        $desc = $descriptions[$action] ?? 'Action';
        $desc .= ' de ' . $model;
        if ($modelId) {
            $desc .= ' (ID: ' . $modelId . ')';
        }

        return $desc;
    }

    /**
     * Récupérer les logs récents
     */
    public static function getRecentLogs(int $limit = 50, int $days = 7)
    {
        return AuditLog::query()
            ->where('created_at', '>=', now()->subDays($days))
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupérer les logs par utilisateur
     */
    public static function getUserLogs(?int $userId = null, int $limit = 50)
    {
        return AuditLog::query()
            ->where('user_id', $userId ?? auth()->id())
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupérer les logs par action
     */
    public static function getActionLogs(string $action, int $limit = 50)
    {
        return AuditLog::query()
            ->where('action', $action)
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupérer les logs par modèle
     */
    public static function getModelLogs(string $model, int $limit = 50)
    {
        return AuditLog::query()
            ->where('model', $model)
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupérer les erreurs
     */
    public static function getErrors(int $limit = 50)
    {
        return AuditLog::query()
            ->where('severity', 'error')
            ->orWhere('response_status', '>=', 500)
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }
}
