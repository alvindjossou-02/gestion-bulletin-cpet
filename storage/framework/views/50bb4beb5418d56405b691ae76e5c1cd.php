

<?php $__env->startSection('content'); ?>
<div class="page-container">
    <div class="page-header">
        <div class="header-back">
            <a href="<?php echo e(route('audit-logs.index')); ?>" class="btn-back">← Retour aux logs</a>
        </div>
        <h1>📋 Détails du Log d'Audit</h1>
    </div>

    <div class="detail-card">
        <!-- Informations générales -->
        <div class="detail-section">
            <h2>Informations Générales</h2>
            <div class="detail-grid">
                <div class="detail-item">
                    <label>ID</label>
                    <p><?php echo e($log->id); ?></p>
                </div>

                <div class="detail-item">
                    <label>Utilisateur</label>
                    <p>
                        <?php if($log->user): ?>
                            <strong><?php echo e($log->user->name); ?></strong><br>
                            <small><?php echo e($log->user->email); ?></small>
                        <?php else: ?>
                            <span class="badge-secondary">Utilisateur supprimé</span>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="detail-item">
                    <label>Action</label>
                    <p>
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
                    </p>
                </div>

                <div class="detail-item">
                    <label>Modèle</label>
                    <p><?php echo e($log->model); ?></p>
                </div>

                <div class="detail-item">
                    <label>ID Modèle</label>
                    <p><?php echo e($log->model_id ?? 'N/A'); ?></p>
                </div>

                <div class="detail-item">
                    <label>Date/Heure</label>
                    <p><?php echo e($log->created_at ? $log->created_at->format('d/m/Y H:i:s') : 'N/A'); ?></p>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="detail-section">
            <h2>Description</h2>
            <div class="description-box">
                <?php echo e($log->description); ?>

            </div>
        </div>

        <!-- Informations de connexion -->
        <div class="detail-section">
            <h2>Informations de Connexion</h2>
            <div class="detail-grid">
                <div class="detail-item full-width">
                    <label>Adresse IP</label>
                    <p><code><?php echo e($log->ip_address); ?></code></p>
                </div>

                <div class="detail-item full-width">
                    <label>User Agent (Navigateur)</label>
                    <p><code class="user-agent"><?php echo e($log->user_agent ?? 'N/A'); ?></code></p>
                </div>
            </div>
        </div>

        <!-- Anciennes valeurs -->
        <?php if($log->old_values): ?>
            <div class="detail-section">
                <h2>📌 Anciennes Valeurs</h2>
                <div class="json-box bg-red-50">
                    <table class="json-table">
                        <thead>
                            <tr>
                                <th>Champ</th>
                                <th>Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $log->old_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($key); ?></strong></td>
                                    <td>
                                        <?php if(is_array($value) || is_object($value)): ?>
                                            <code><?php echo e(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); ?></code>
                                        <?php elseif(strlen($value) > 50): ?>
                                            <code title="<?php echo e($value); ?>"><?php echo e(substr($value, 0, 50)); ?>...</code>
                                        <?php else: ?>
                                            <code><?php echo e($value); ?></code>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Nouvelles valeurs -->
        <?php if($log->new_values): ?>
            <div class="detail-section">
                <h2>✅ Nouvelles Valeurs</h2>
                <div class="json-box bg-green-50">
                    <table class="json-table">
                        <thead>
                            <tr>
                                <th>Champ</th>
                                <th>Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $log->new_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($key); ?></strong></td>
                                    <td>
                                        <?php if(is_array($value) || is_object($value)): ?>
                                            <code><?php echo e(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); ?></code>
                                        <?php elseif(strlen($value) > 50): ?>
                                            <code title="<?php echo e($value); ?>"><?php echo e(substr($value, 0, 50)); ?>...</code>
                                        <?php else: ?>
                                            <code><?php echo e($value); ?></code>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .page-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 16px;
        background: #F3F4F6;
        color: #111827;
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: #E5E7EB;
    }

    .page-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .detail-card {
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        overflow: hidden;
    }

    .detail-section {
        padding: 30px;
        border-bottom: 1px solid #E5E7EB;
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    .detail-section h2 {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 20px 0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-item label {
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 8px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-item p {
        color: #111827;
        font-size: 15px;
        margin: 0;
        line-height: 1.5;
    }

    .description-box {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 16px;
        color: #374151;
        line-height: 1.6;
    }

    .json-box {
        border-radius: 6px;
        border: 1px solid #E5E7EB;
        padding: 16px;
        overflow-x: auto;
    }

    .bg-red-50 {
        background: #FEF2F2;
        border-color: #FECACA;
    }

    .bg-green-50 {
        background: #F0FDF4;
        border-color: #86EFAC;
    }

    .json-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .json-table thead {
        background: rgba(0, 0, 0, 0.05);
        border-bottom: 1px solid currentColor;
        opacity: 0.7;
    }

    .json-table th {
        padding: 10px;
        text-align: left;
        font-weight: 600;
    }

    .json-table td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .json-table code {
        background: rgba(0, 0, 0, 0.05);
        padding: 4px 8px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        color: #374151;
        word-break: break-all;
        display: block;
        line-height: 1.4;
    }

    .user-agent {
        word-break: break-all;
        font-size: 11px;
    }

    .badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        width: fit-content;
    }

    .badge-create { background: #DBEAFE; color: #065F46; }
    .badge-update { background: #FEF3C7; color: #92400E; }
    .badge-delete { background: #FEE2E2; color: #7F1D1D; }
    .badge-login { background: #DBEAFE; color: #1E40AF; }
    .badge-logout { background: #F3F4F6; color: #374151; }

    .badge-secondary {
        background: #E5E7EB;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-section {
            padding: 20px;
        }

        .json-table {
            font-size: 11px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/admin/audit-logs/show.blade.php ENDPATH**/ ?>