<?php $__env->startSection('title', 'Mes Notes - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Mes Notes</h1>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="text-gray-900 dark:text-gray-100">

                <?php if($notes->count()): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Matière</th>
                                    <th scope="col" class="px-6 py-3">Type d'Évaluation</th>
                                    <th scope="col" class="px-6 py-3">Note</th>
                                    <th scope="col" class="px-6 py-3">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium"><?php echo e($note->matiere?->nom_matiere ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4"><?php echo e($note->type_evaluation); ?></td>
                                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800"><?php echo e($note->note); ?>/20</span></td>
                                        <td class="px-6 py-4">
                                            <?php if($note->note >= 12): ?>
                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800">✓ Réussi</span>
                                            <?php else: ?>
                                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-800">✗ Insuffisant</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <?php if(isset($isLinked) && !$isLinked): ?>
                        <p class="text-gray-500 text-center py-8">Votre compte n'est pas encore lié à une fiche apprenant. Contactez l'administration pour associer votre profil.</p>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">Aucune note disponible.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/notes/my-notes.blade.php ENDPATH**/ ?>