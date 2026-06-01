<?php $__env->startSection('title', 'Statistiques - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Tableau de Bord - Statistiques</h1>

        <!-- Statistiques principales -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Apprenants</p>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_apprenants']); ?></p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Classes</p>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_classes']); ?></p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Filières</p>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_filieres']); ?></p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Notes</p>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_notes']); ?></p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Bulletins</p>
                <p class="text-3xl font-bold text-indigo-600"><?php echo e($stats['total_bulletins']); ?></p>
            </div>
        </div>

        <!-- Meilleurs apprenants -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Top 10 Apprenants</h2>
            <?php if($topApprenants->count()): ?>
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Apprenant</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $topApprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $bulletin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">#<?php echo e($idx + 1); ?> - <?php echo e($bulletin->apprenant?->nom); ?> <?php echo e($bulletin->apprenant?->prenom); ?></td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-green-100 text-green-800"><?php echo e($bulletin->moyenne_generale); ?>/20</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500">Aucune donnée disponible.</p>
            <?php endif; ?>
        </div>

        <!-- Distribution des notes -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Distribution des Notes</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="p-4 bg-green-100 rounded">
                    <p class="text-green-800 font-semibold">Excellent (18-20)</p>
                    <p class="text-2xl font-bold text-green-600"><?php echo e($notesDistribution['excellent']); ?></p>
                </div>
                <div class="p-4 bg-blue-100 rounded">
                    <p class="text-blue-800 font-semibold">Très Bon (16-17)</p>
                    <p class="text-2xl font-bold text-blue-600"><?php echo e($notesDistribution['tres_bon']); ?></p>
                </div>
                <div class="p-4 bg-indigo-100 rounded">
                    <p class="text-indigo-800 font-semibold">Bon (14-15)</p>
                    <p class="text-2xl font-bold text-indigo-600"><?php echo e($notesDistribution['bon']); ?></p>
                </div>
                <div class="p-4 bg-yellow-100 rounded">
                    <p class="text-yellow-800 font-semibold">Acceptable (12-13)</p>
                    <p class="text-2xl font-bold text-yellow-600"><?php echo e($notesDistribution['acceptable']); ?></p>
                </div>
                <div class="p-4 bg-orange-100 rounded">
                    <p class="text-orange-800 font-semibold">Passable (10-11)</p>
                    <p class="text-2xl font-bold text-orange-600"><?php echo e($notesDistribution['passable']); ?></p>
                </div>
                <div class="p-4 bg-red-100 rounded">
                    <p class="text-red-800 font-semibold">Faible (&lt;10)</p>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($notesDistribution['faible']); ?></p>
                </div>
            </div>
        </div>

        <!-- Statistiques par classe -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Statistiques par Classe</h2>
            <?php if($classesStats->count()): ?>
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Classe</th>
                            <th class="px-4 py-2 text-left">Apprenants</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $classesStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 font-semibold"><?php echo e($classe['nom']); ?></td>
                                <td class="px-4 py-2"><?php echo e($classe['total_apprenants']); ?></td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800"><?php echo e(round($classe['moyenne_generale'], 2)); ?>/20</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500">Aucune donnée disponible.</p>
            <?php endif; ?>
        </div>

        <!-- Statistiques par filière -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Statistiques par Filière</h2>
            <?php if($filieresStats->count()): ?>
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Filière</th>
                            <th class="px-4 py-2 text-left">Apprenants</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $filieresStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filiere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 font-semibold"><?php echo e($filiere['nom']); ?></td>
                                <td class="px-4 py-2"><?php echo e($filiere['total_apprenants']); ?></td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800"><?php echo e(round($filiere['moyenne_generale'], 2)); ?>/20</span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500">Aucune donnée disponible.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/statistics/index.blade.php ENDPATH**/ ?>