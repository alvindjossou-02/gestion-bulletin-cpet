

<?php $__env->startSection('title', 'Apprenants - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 600; color: #111827;">Apprenants</h1>
        <a href="<?php echo e(route('apprenants.create')); ?>" style="display: inline-flex; align-items: center; padding: 10px 20px; background: linear-gradient(135deg, #0052CC 0%, #003D99 100%); color: white; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 8px 20px rgba(0, 82, 204, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow=''; this.style.transform=''">➕ Ajouter un apprenant</a>
    </div>

    <?php if(session('success')): ?>
        <div style="margin-bottom: 20px; padding: 12px 16px; background-color: #ECFDF5; color: #065F46; border: 1px solid #D1FAE5; border-radius: 8px; font-size: 14px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($apprenants->count()): ?>
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead style="background-color: #F3F4F6; border-bottom: 1px solid #E5E7EB;">
                    <tr>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Nom</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Prénom</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Matricule</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Sexe</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Filière</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Classe</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Reboublant</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $apprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apprenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #E5E7EB;">
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->nom); ?></td>
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->prenom); ?></td>
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->matricule); ?></td>
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->sexe); ?></td>
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->filiere?->nom_filiere ?? 'N/A'); ?></td>
                            <td style="padding: 16px; color: #111827;"><?php echo e($apprenant->classe?->nom_classe ?? 'N/A'); ?></td>
                            <td style="padding: 16px;">
                                <?php if($apprenant->reboublant): ?>
                                    <span style="display: inline-block; padding: 4px 12px; background-color: #FEF3C7; color: #78350F; border-radius: 20px; font-size: 12px; font-weight: 600;">Oui</span>
                                <?php else: ?>
                                    <span style="display: inline-block; padding: 4px 12px; background-color: #ECFDF5; color: #065F46; border-radius: 20px; font-size: 12px; font-weight: 600;">Non</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 16px;">
                                <a href="<?php echo e(route('apprenants.edit', $apprenant)); ?>" style="color: #0052CC; text-decoration: none; margin-right: 16px; font-weight: 600;">Modifier</a>
                                <form action="<?php echo e(route('apprenants.destroy', $apprenant)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="background: none; border: none; color: #DC2626; cursor: pointer; text-decoration: none; font-weight: 600;">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <?php echo e($apprenants->links()); ?>

        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 12px; padding: 40px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <p style="color: #4B5563; font-size: 16px;">Aucun apprenant trouvé.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/apprenants/index.blade.php ENDPATH**/ ?>