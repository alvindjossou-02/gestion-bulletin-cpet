

<?php $__env->startSection('title', 'Enregistrer Absence - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Enregistrer une absence</h1>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('absences.store')); ?>" class="space-y-6">
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
                        <label for="date_absence" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date d'absence</label>
                        <input type="date" name="date_absence" id="date_absence" value="<?php echo e(old('date_absence')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="justifiee" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" <?php echo e(old('justifiee') ? 'checked' : ''); ?>>
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">Justifiée</span>
                        </label>
                    </div>

                    <div>
                        <label for="motif" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motif (optionnel)</label>
                        <input type="text" name="motif" id="motif" value="<?php echo e(old('motif')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="<?php echo e(route('absences.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/absences/create.blade.php ENDPATH**/ ?>