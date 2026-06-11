

<?php $__env->startSection('title', 'Ajouter Matière - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Ajouter une matière</h1>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('matieres.store')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="nom_matiere" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la matière</label>
                        <input id="nom_matiere" name="nom_matiere" type="text" value="<?php echo e(old('nom_matiere')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="coefficient" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coefficient</label>
                        <input id="coefficient" name="coefficient" type="number" min="1" max="10" value="<?php echo e(old('coefficient')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="filiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filière</label>
                        <select id="filiere_id" name="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une filière --</option>
                            <?php $__currentLoopData = $filieres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filiere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($filiere->id); ?>" <?php echo e(old('filiere_id') == $filiere->id ? 'selected' : ''); ?>><?php echo e($filiere->nom_filiere); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Classe (optionnel)</label>
                        <select id="classe_id" name="classe_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <option value="">-- Aucune classe spécifique --</option>
                            <?php if(isset($classes)): ?>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($classe->id); ?>" <?php echo e(old('classe_id') == $classe->id ? 'selected' : ''); ?>><?php echo e($classe->nom_classe); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="<?php echo e(route('matieres.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/matieres/create.blade.php ENDPATH**/ ?>