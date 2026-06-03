<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Arr;

trait LogsActivity
{
    /**
     * Boot the trait
     */
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::logActivity('create', $model, null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $oldValues = [];
            $newValues = [];

            foreach ($model->getChanges() as $key => $newValue) {
                $oldValues[$key] = $model->getOriginal($key);
                $newValues[$key] = $newValue;
            }

            static::logActivity('update', $model, $oldValues, $newValues);
        });

        static::deleted(function ($model) {
            static::logActivity('delete', $model, $model->getAttributes(), null);
        });
    }

    /**
     * Enregistrer une activité
     */
    public static function logActivity($action, $model, $oldValues, $newValues)
    {
        try {
            $userId = auth()->id() ?? null;

            AuditLog::create([
                'user_id' => $userId,
                'action' => $action,
                'model' => class_basename($model),
                'model_id' => $model->id,
                'old_values' => $oldValues ? Arr::except($oldValues, ['password', 'remember_token']) : null,
                'new_values' => $newValues ? Arr::except($newValues, ['password', 'remember_token']) : null,
                'ip_address' => request()->ip() ?? '0.0.0.0',
                'user_agent' => request()->userAgent() ?? null,
                'description' => static::getDescription($action, $model),
            ]);
        } catch (\Exception $e) {
            // Silencieusement ignorer les erreurs de logging pour ne pas bloquer l'appli
            \Log::error('Audit log error: ' . $e->getMessage());
        }
    }

    /**
     * Générer une description lisible
     */
    private static function getDescription($action, $model)
    {
        $user = auth()->user();
        $userName = $user ? $user->name : 'Utilisateur inconnu';

        return match ($action) {
            'create' => "{$userName} a créé " . class_basename($model) . " (ID: {$model->id})",
            'update' => "{$userName} a modifié " . class_basename($model) . " (ID: {$model->id})",
            'delete' => "{$userName} a supprimé " . class_basename($model) . " (ID: {$model->id})",
            default => "{$userName} a effectué l'action '{$action}' sur " . class_basename($model),
        };
    }
}
