

<?php $__env->startSection('content'); ?>
<div class="page-container">
    <div class="page-header">
        <div class="header-title">
            <h1>📋 Journaux d'Audit</h1>
            <p>Trace complète de toutes les actions effectuées dans le système</p>
        </div>
    </div>

    <!-- Filtres -->
    <div class="filters-card">
        <form method="GET" action="<?php echo e(route('audit-logs.index')); ?>" class="filters-form">
            <div class="filter-group">
                <label for="search">Rechercher</label>
                <input type="search" id="search" name="search" placeholder="Rechercher dans la description..." value="<?php echo e(request('search')); ?>">
            </div>

            <div class="filter-group">
                <label for="action">Action</label>
                <select id="action" name="action">
                    <option value="">-- Toutes les actions --</option>
                    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($action); ?>" <?php echo e(request('action') === $action ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($action)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="model">Modèle</label>
                <select id="model" name="model">
                    <option value="">-- Tous les modèles --</option>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($model); ?>" <?php echo e(request('model') === $model ? 'selected' : ''); ?>>
                            <?php echo e($model); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="days">Période</label>
                <select id="days" name="days">
                    <option value="">-- Tout le temps --</option>
                    <option value="1" <?php echo e(request('days') === '1' ? 'selected' : ''); ?>>Dernier jour</option>
                    <option value="7" <?php echo e(request('days') === '7' ? 'selected' : ''); ?>>7 derniers jours</option>
                    <option value="30" <?php echo e(request('days') === '30' ? 'selected' : ''); ?>>30 derniers jours</option>
                </select>
            </div>

            <button type="submit" class="btn-filter">🔍 Filtrer</button>
            <a href="<?php echo e(route('audit-logs.index')); ?>" class="btn-reset">Réinitialiser</a>
            <a href="<?php echo e(route('audit-logs.export', request()->query())); ?>" class="btn-export">📥 Exporter CSV</a>
        </form>
    </div>

    <!-- Tableau des logs -->
    <div class="table-card">
        <?php if($logs->count() > 0): ?>
            <table class="audit-table">
                <thead>
                    <tr>
                        <th>Date/Heure</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                        <th>Modèle</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="log-row log-<?php echo e($log->action); ?>">
                            <td class="text-muted">
                                <?php echo e($log->created_at->format('d/m/Y H:i:s')); ?>

                            </td>
                            <td>
                                <?php if($log->user): ?>
                                    <strong><?php echo e($log->user->name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e($log->user->email); ?></small>
                                <?php else: ?>
                                    <span class="badge-secondary">Utilisateur supprimé</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo e($log->action); ?>">
                                    <?php switch($log->action):
                                        case ('create'): ?>
                                            ➕ Créé
                                            <?php break; ?>
                                        <?php case ('update'): ?>
                                            ✏️ Modifié
                                            <?php break; ?>
                                        <?php case ('delete'): ?>
                                            🗑️ Supprimé
                                            <?php break; ?>
                                        <?php case ('login'): ?>
                                            🔓 Connexion
                                            <?php break; ?>
                                        <?php case ('logout'): ?>
                                            🔒 Déconnexion
                                            <?php break; ?>
                                        <?php default: ?>
                                            <?php echo e(ucfirst($log->action)); ?>

                                    <?php endswitch; ?>
                                </span>
                            </td>
                            <td>
                                <small class="bg-gray-100 px-2 py-1 rounded"><?php echo e($log->model); ?></small>
                                <?php if($log->model_id): ?>
                                    <br>
                                    <small class="text-muted">ID: <?php echo e($log->model_id); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($log->description); ?></td>
                            <td>
                                <small class="text-muted"><?php echo e($log->ip_address); ?></small>
                            </td>
                            <td>
                                <a href="<?php echo e(route('audit-logs.show', $log)); ?>" class="btn-small btn-view">👁️ Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <?php echo e($logs->links()); ?>

            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>📭 Aucun log d'audit trouvé</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .filters-card {
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .filters-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #111827;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn-filter, .btn-reset, .btn-export {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter {
        background: #0052CC;
        color: white;
    }

    .btn-filter:hover {
        background: #003D99;
    }

    .btn-reset {
        background: #F3F4F6;
        color: #111827;
    }

    .btn-reset:hover {
        background: #E5E7EB;
    }

    .btn-export {
        background: #20C997;
        color: white;
    }

    .btn-export:hover {
        background: #12A366;
    }

    .table-card {
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        overflow: hidden;
    }

    .audit-table {
        width: 100%;
        border-collapse: collapse;
    }

    .audit-table thead {
        background: #F9FAFB;
        border-bottom: 2px solid #E5E7EB;
    }

    .audit-table th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: #111827;
    }

    .audit-table tbody tr {
        border-bottom: 1px solid #E5E7EB;
    }

    .audit-table tbody tr:hover {
        background: #F9FAFB;
    }

    .audit-table td {
        padding: 16px;
        color: #374151;
    }

    .log-row.log-create { border-left: 4px solid #10B981; }
    .log-row.log-update { border-left: 4px solid #F59E0B; }
    .log-row.log-delete { border-left: 4px solid #EF4444; }
    .log-row.log-login { border-left: 4px solid #0052CC; }
    .log-row.log-logout { border-left: 4px solid #6B7280; }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
    }

    .badge-create {
        background: #DBEAFE;
        color: #065F46;
    }

    .badge-update {
        background: #FEF3C7;
        color: #92400E;
    }

    .badge-delete {
        background: #FEE2E2;
        color: #7F1D1D;
    }

    .badge-login {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .badge-logout {
        background: #F3F4F6;
        color: #374151;
    }

    .badge-secondary {
        background: #E5E7EB;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .btn-small {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: #DBEAFE;
        color: #1E40AF;
    }

    .btn-view:hover {
        background: #BFDBFE;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6B7280;
    }

    .pagination-container {
        padding: 20px;
        border-top: 1px solid #E5E7EB;
    }

    .text-muted {
        color: #6B7280;
    }

    @media (max-width: 768px) {
        .filters-form {
            grid-template-columns: 1fr;
        }

        .audit-table {
            font-size: 12px;
        }

        .audit-table th, .audit-table td {
            padding: 8px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/admin/audit-logs/index.blade.php ENDPATH**/ ?>