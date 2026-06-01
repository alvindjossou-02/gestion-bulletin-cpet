<?php $__env->startSection('title', 'Créer Bulletin - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Générer un Bulletin</h1>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('bulletins.store')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="apprenant_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apprenant</label>
                        <select name="apprenant_id" id="apprenant_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner un apprenant --</option>
                            <?php $__currentLoopData = $apprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apprenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($apprenant->id); ?>" <?php echo e(old('apprenant_id') == $apprenant->id ? 'selected' : ''); ?>>
                                    <?php echo e($apprenant->nom); ?> <?php echo e($apprenant->prenom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="trimestre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Trimestre</label>
                        <select name="trimestre" id="trimestre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <?php $__currentLoopData = $trimestres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trimestre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($trimestre); ?>" <?php echo e(old('trimestre') == $trimestre ? 'selected' : ''); ?>><?php echo e($trimestre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="moyenne_generale" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Moyenne Générale (0-20)</label>
                        <input type="number" name="moyenne_generale" id="moyenne_generale" min="0" max="20" step="0.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required value="<?php echo e(old('moyenne_generale')); ?>">
                    </div>

                    <div>
                        <label for="rang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rang</label>
                        <input type="number" name="rang" id="rang" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required value="<?php echo e(old('rang')); ?>">
                    </div>

                    <div>
                        <label for="appreciation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Appréciation</label>
                        <textarea name="appreciation" id="appreciation" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600"><?php echo e(old('appreciation')); ?></textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="<?php echo e(route('bulletins.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/bulletins/create.blade.php ENDPATH**/ ?>