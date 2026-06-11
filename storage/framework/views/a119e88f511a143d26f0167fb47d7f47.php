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

        <!-- Graphiques Chart.js -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Distribution des notes (Pie Chart) -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Distribution des Notes</h2>
                <canvas id="notesDistributionChart" style="max-height: 300px;"></canvas>
            </div>

            <!-- Apprenants par Filière (Doughnut Chart) -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Apprenants par Filière</h2>
                <canvas id="apprenantsByFiliereChart" style="max-height: 300px;"></canvas>
            </div>

            <!-- Apprenants par Classe (Bar Chart) -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow md:col-span-2">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Apprenants par Classe</h2>
                <canvas id="apprenantsByClasseChart" style="max-height: 300px;"></canvas>
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

<script>
    // Colors for charts
    const colors = {
        primary: '#0052CC',
        green: '#10B981',
        red: '#EF4444',
        yellow: '#F59E0B',
        blue: '#3B82F6',
        purple: '#A855F7',
        pink: '#EC4899',
        indigo: '#6366F1'
    };

    // Notes Distribution Chart (Pie)
    <?php if($notesDistribution): ?>
    const notesCtx = document.getElementById('notesDistributionChart').getContext('2d');
    new Chart(notesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Excellent (18-20)', 'Très Bon (16-17)', 'Bon (14-15)', 'Acceptable (12-13)', 'Passable (10-11)', 'Faible (<10)'],
            datasets: [{
                label: 'Distribution des Notes',
                data: [
                    <?php echo e($notesDistribution['excellent']); ?>,
                    <?php echo e($notesDistribution['tres_bon']); ?>,
                    <?php echo e($notesDistribution['bon']); ?>,
                    <?php echo e($notesDistribution['acceptable']); ?>,
                    <?php echo e($notesDistribution['passable']); ?>,
                    <?php echo e($notesDistribution['faible']); ?>

                ],
                backgroundColor: [
                    '#10B981',
                    '#3B82F6',
                    '#6366F1',
                    '#F59E0B',
                    '#F97316',
                    '#EF4444'
                ],
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 20, font: { size: 12 } }
                }
            }
        }
    });
    <?php endif; ?>

    // Apprenants par Filière Chart (Doughnut)
    <?php
    $filieresCount = \App\Models\Filiere::withCount('apprenants')->get();
    ?>
    <?php if($filieresCount->count() > 0): ?>
    const filiereCtx = document.getElementById('apprenantsByFiliereChart').getContext('2d');
    new Chart(filiereCtx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php $__currentLoopData = $filieresCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($f->nom); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            datasets: [{
                label: 'Apprenants par Filière',
                data: [
                    <?php $__currentLoopData = $filieresCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($f->apprenants_count); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                backgroundColor: [
                    colors.primary,
                    colors.green,
                    colors.purple,
                    colors.pink,
                    colors.indigo,
                    colors.blue,
                    colors.yellow,
                    colors.red
                ],
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 20, font: { size: 12 } }
                }
            }
        }
    });
    <?php endif; ?>

    // Apprenants par Classe Chart (Bar)
    <?php
    $classesCount = \App\Models\Classe::withCount('apprenants')->get();
    ?>
    <?php if($classesCount->count() > 0): ?>
    const classeCtx = document.getElementById('apprenantsByClasseChart').getContext('2d');
    new Chart(classeCtx, {
        type: 'bar',
        data: {
            labels: [
                <?php $__currentLoopData = $classesCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($c->nom); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            datasets: [{
                label: 'Nombre d\'Apprenants',
                data: [
                    <?php $__currentLoopData = $classesCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($c->apprenants_count); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                backgroundColor: colors.primary,
                borderColor: colors.primary,
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            indexAxis: 'x',
            plugins: {
                legend: {
                    display: true,
                    labels: { padding: 20, font: { size: 12 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/statistics/index.blade.php ENDPATH**/ ?>