<?php $__env->startSection('title', 'Bulletins - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Bulletins</h1>
                    <a href="<?php echo e(route('bulletins.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        + Générer Bulletin
                    </a>
                </div>

                <?php if($bulletins->count()): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Apprenant</th>
                                    <th scope="col" class="px-6 py-3">Trimestre</th>
                                    <th scope="col" class="px-6 py-3">Moyenne</th>
                                    <th scope="col" class="px-6 py-3">Rang</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bulletins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulletin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium"><?php echo e($bulletin->apprenant?->nom ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4"><?php echo e($bulletin->trimestre); ?></td>
                                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800"><?php echo e($bulletin->moyenne_generale); ?>/20</span></td>
                                        <td class="px-6 py-4"><?php echo e($bulletin->rang); ?>e</td>
                                        <td class="px-6 py-4 flex gap-2">
                                            <a href="<?php echo e(route('bulletins.pdf', $bulletin)); ?>" class="text-red-600 hover:text-red-900" title="Télécharger PDF">PDF</a>
                                            <a href="<?php echo e(route('bulletins.edit', $bulletin)); ?>" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form method="POST" action="<?php echo e(route('bulletins.destroy', $bulletin)); ?>" class="inline" onsubmit="return confirm('Êtes-vous sûr ?');">
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
                        <?php echo e($bulletins->links()); ?>

                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-8">Aucun bulletin généré.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/bulletins/index.blade.php ENDPATH**/ ?>