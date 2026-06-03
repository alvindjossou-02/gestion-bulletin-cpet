<?php $__env->startSection('title', 'Dashboard - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 600; margin-bottom: 32px; color: #111827;">Bienvenue sur le Dashboard</h1>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
            <!-- Card Statistiques -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #0052CC;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Apprenants</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;"><?php echo e(\App\Models\Apprenant::count()); ?></div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #20C997;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Classes</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;"><?php echo e(\App\Models\Classe::count()); ?></div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #0052CC;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Matières</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;"><?php echo e(\App\Models\Matiere::count()); ?></div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #20C997;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Notes</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;"><?php echo e(\App\Models\Note::count()); ?></div>
            </div>
        </div>

        <?php if(auth()->user()->hasRole(['administrateur', 'directeur'])): ?>
            <div style="margin-top: 32px;">
                <a href="<?php echo e(route('audit-logs.index')); ?>" style="display: inline-block; background: #0052CC; color: white; padding: 16px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 82, 204, 0.2);" 
                   onmouseover="this.style.background='#003D99'; this.style.boxShadow='0 4px 12px rgba(0, 82, 204, 0.3)';" 
                   onmouseout="this.style.background='#0052CC'; this.style.boxShadow='0 2px 8px rgba(0, 82, 204, 0.2)';">
                    📋 Journaux d'Audit
                </a>
            </div>
        <?php endif; ?>

        <div style="margin-top: 32px; background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <h2 style="font-size: 18px; font-weight: 600; margin-bottom: 16px; color: #111827;">Dernier Utilisateur Connecté</h2>
            <p style="color: #4B5563;">Bonjour <strong><?php echo e(auth()->user()->name); ?></strong>, bienvenue sur la gestion des bulletins du CPET.</p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/dashboard.blade.php ENDPATH**/ ?>