<?php

namespace App\Traits;

use App\Services\AuditService;

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
     * Enregistrer une activité via AuditService
     */
    public static function logActivity($action, $model, $oldValues, $newValues)
    {
        try {
            AuditService::logModelAction(
                $action,
                class_basename($model),
                $model->id,
                $oldValues,
                $newValues,
                static::getDescription($action, $model)
            );
        } catch (\Exception $e) {
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
