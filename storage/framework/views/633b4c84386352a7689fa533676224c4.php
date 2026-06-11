<?php $__env->startSection('title', 'Saisir Notes - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Saisir les Notes</h1>
                    <a href="<?php echo e(route('notes.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150">
                        + Ajouter une Note
                    </a>
                </div>

                <?php if($notes->count()): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Apprenant</th>
                                    <th scope="col" class="px-6 py-3">Matière</th>
                                    <th scope="col" class="px-6 py-3">Type d'Évaluation</th>
                                    <th scope="col" class="px-6 py-3">Note</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 font-medium"><?php echo e($note->apprenant?->nom ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4"><?php echo e($note->matiere?->nom_matiere ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4"><?php echo e($note->type_evaluation); ?></td>
                                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800"><?php echo e($note->note); ?>/20</span></td>
                                        <td class="px-6 py-4 flex gap-2">
                                            <a href="<?php echo e(route('notes.edit', $note)); ?>" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form method="POST" action="<?php echo e(route('notes.destroy', $note)); ?>" class="inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <?php echo e($notes->links()); ?>

                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-8">Aucune note enregistrée.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/notes/index.blade.php ENDPATH**/ ?>