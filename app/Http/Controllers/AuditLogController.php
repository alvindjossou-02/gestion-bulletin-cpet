<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Afficher tous les logs d'audit
     */
    public function index(Request $request): View
    {
        $query = AuditLog::with('user');

        // Filtrer par action
        if ($request->filled('action')) {
            $query->byAction($request->action);
        }

        // Filtrer par modèle
        if ($request->filled('model')) {
            $query->byModel($request->model);
        }

        // Filtrer par utilisateur
        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        // Filtrer par période
        if ($request->filled('days')) {
            $query->recent($request->days);
        }

        // Recherche par description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $logs = $query->latest('created_at')->paginate(50);

        return view('admin.audit-logs.index', [
            'logs' => $logs,
            'actions' => AuditLog::getActions(),
            'models' => AuditLog::getModels(),
        ]);
    }

    /**
     * Afficher les détails d'un log
     */
    public function show(AuditLog $log): View
    {
        return view('admin.audit-logs.show', ['log' => $log]);
    }

    /**
     * Exporter les logs en CSV
     */
    public function export(Request $request)
    {
        $query = AuditLog::with('user');

        if ($request->filled('action')) {
            $query->byAction($request->action);
        }
        if ($request->filled('model')) {
            $query->byModel($request->model);
        }

        $logs = $query->latest('created_at')->get();

        $filename = 'audit_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->stream(function () use ($logs) {
            $fp = fopen('php://output', 'w');
            
            // Header
            fputcsv($fp, [
                'ID',
                'Utilisateur',
                'Action',
                'Modèle',
                'ID Modèle',
                'Adresse IP',
                'Navigateur',
                'Description',
                'Date/Heure',
            ]);

            // Data
            foreach ($logs as $log) {
                fputcsv($fp, [
                    $log->id,
                    $log->user?->name ?? 'N/A',
                    $log->action,
                    $log->model,
                    $log->model_id,
                    $log->ip_address,
                    substr($log->user_agent ?? '', 0, 50),
                    $log->description,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($fp);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
