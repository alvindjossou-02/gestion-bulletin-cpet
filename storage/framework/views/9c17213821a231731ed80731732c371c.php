

<?php $__env->startSection('title', 'Modifier Apprenant - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Modifier l'apprenant</h1>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('apprenants.update', $apprenant)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                        <input id="nom" name="nom" type="text" value="<?php echo e(old('nom', $apprenant->nom)); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                        <input id="prenom" name="prenom" type="text" value="<?php echo e(old('prenom', $apprenant->prenom)); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="matricule" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Matricule</label>
                        <input id="matricule" name="matricule" type="text" value="<?php echo e(old('matricule', $apprenant->matricule)); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="sexe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sexe</label>
                        <select id="sexe" name="sexe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="M" <?php echo e(old('sexe', $apprenant->sexe) == 'M' ? 'selected' : ''); ?>>M</option>
                            <option value="F" <?php echo e(old('sexe', $apprenant->sexe) == 'F' ? 'selected' : ''); ?>>F</option>
                        </select>
                    </div>

                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de naissance</label>
                        <input id="date_naissance" name="date_naissance" type="date" value="<?php echo e(old('date_naissance', $apprenant->date_naissance?->format('Y-m-d'))); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="lieu_naissance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lieu de naissance</label>
                        <input id="lieu_naissance" name="lieu_naissance" type="text" value="<?php echo e(old('lieu_naissance', $apprenant->lieu_naissance)); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="reboublant" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" <?php echo e(old('reboublant', $apprenant->reboublant) ? 'checked' : ''); ?>>
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">Reboublant</span>
                        </label>
                    </div>

                    <div>
                        <label for="filiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filière</label>
                        <select id="filiere_id" name="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une filière --</option>
                            <?php $__currentLoopData = $filieres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filiere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($filiere->id); ?>" <?php echo e(old('filiere_id', $apprenant->filiere_id) == $filiere->id ? 'selected' : ''); ?>><?php echo e($filiere->nom_filiere); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Classe</label>
                        <select id="classe_id" name="classe_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une classe --</option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($classe->id); ?>" <?php echo e(old('classe_id', $apprenant->classe_id) == $classe->id ? 'selected' : ''); ?>><?php echo e($classe->nom_classe); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="<?php echo e(route('apprenants.index')); ?>" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/apprenants/edit.blade.php ENDPATH**/ ?>