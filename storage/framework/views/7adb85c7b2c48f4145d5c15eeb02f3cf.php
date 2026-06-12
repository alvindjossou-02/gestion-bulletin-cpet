

<?php $__env->startSection('title', 'Classes - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Classes</h1>
                    <a href="<?php echo e(route('classes.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Ajouter une classe</a>
                </div>


                <?php if($classes->count()): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3">Classe</th>
                                    <th class="px-6 py-3">Apprenants</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($classe->nom_classe); ?></td>
                                        <td class="px-6 py-4"><?php echo e($classe->apprenants?->count() ?? 0); ?></td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="<?php echo e(route('classes.edit', $classe)); ?>" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="<?php echo e(route('classes.destroy', $classe)); ?>" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?');">
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
                        <?php echo e($classes->links()); ?>

                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune classe créée.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/classes/index.blade.php ENDPATH**/ ?>