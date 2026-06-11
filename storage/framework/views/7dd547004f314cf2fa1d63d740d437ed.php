<?php $__env->startSection('title', 'Tableau de Bord - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, <?php echo e(auth()->user()->name); ?>!</h1>
            <p class="text-blue-100">Tableau de Bord - Gestion des Bulletins Scolaires</p>
        </div>

        
        <?php if(auth()->user()->hasRole(['administrateur', 'directeur', 'directrice'])): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Apprenant::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Classes</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo e(\App\Models\Classe::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Filières</p>
                        <p class="text-3xl font-bold text-purple-600"><?php echo e(\App\Models\Filiere::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes Saisies</p>
                        <p class="text-3xl font-bold text-orange-600"><?php echo e(\App\Models\Note::count()); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Gestion</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="<?php echo e(route('apprenants.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>👥 Apprenants</span>
                        </a>
                        <a href="<?php echo e(route('classes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>📚 Classes</span>
                        </a>
                        <a href="<?php echo e(route('filieres.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>🎓 Filières</span>
                        </a>
                        <a href="<?php echo e(route('matieres.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>📖 Matières</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Opérations</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="<?php echo e(route('notes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                            <span>✏️ Notes</span>
                        </a>
                        <a href="<?php echo e(route('bulletins.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                            <span>📄 Bulletins</span>
                        </a>
                        <a href="<?php echo e(route('statistics.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                            <span>📊 Stats</span>
                        </a>
                        <?php if(auth()->user()->hasRole(['administrateur'])): ?>
                            <a href="<?php echo e(route('audit-logs.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition duration-150">
                                <span>🔍 Audit</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        
        <?php elseif(auth()->user()->hasRole('enseignant')): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Apprenant::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes Saisies</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo e(\App\Models\Note::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Absences</p>
                        <p class="text-3xl font-bold text-orange-600"><?php echo e(\App\Models\Absence::count()); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <a href="<?php echo e(route('notes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>✏️ Saisir Notes</span>
                    </a>
                    <a href="<?php echo e(route('absences.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="<?php echo e(route('bulletins.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📄 Bulletins</span>
                    </a>
                    <a href="<?php echo e(route('statistics.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>📊 Stats</span>
                    </a>
                </div>
            </div>

        
        <?php elseif(auth()->user()->hasRole('apprenant')): ?>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Informations</h2>
                <?php
                    $apprenant = \App\Models\Apprenant::where('user_id', auth()->id())->first();
                ?>
                <?php if($apprenant): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Nom:</strong> <?php echo e($apprenant->nom); ?> <?php echo e($apprenant->prenom); ?></div>
                        <div><strong>Matricule:</strong> <?php echo e($apprenant->matricule); ?></div>
                        <div><strong>Classe:</strong> <?php echo e($apprenant->classe?->nom ?? 'N/A'); ?></div>
                        <div><strong>Filière:</strong> <?php echo e($apprenant->filiere?->nom ?? 'N/A'); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Mes Notes</p>
                        <?php if($apprenant): ?>
                            <p class="text-3xl font-bold text-blue-600"><?php echo e($apprenant->notes()->count()); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Moyenne</p>
                        <?php if($apprenant && $apprenant->notes()->count() > 0): ?>
                            <?php
                                $moyenne = $apprenant->notes()->avg('note');
                            ?>
                            <p class="text-3xl font-bold text-green-600"><?php echo e(number_format($moyenne, 2)); ?>/20</p>
                        <?php else: ?>
                            <p class="text-3xl font-bold text-gray-400">N/A</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('my-notes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>📝 Mes Notes</span>
                    </a>
                    <a href="<?php echo e(route('bulletins.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📄 Bulletins</span>
                    </a>
                </div>
            </div>

        
        <?php elseif(auth()->user()->hasRole('secretaire')): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Apprenant::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Classes</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo e(\App\Models\Classe::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Absences</p>
                        <p class="text-3xl font-bold text-orange-600"><?php echo e(\App\Models\Absence::count()); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('apprenants.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="<?php echo e(route('absences.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="<?php echo e(route('classes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📚 Classes</span>
                    </a>
                    <a href="<?php echo e(route('statistics.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
            </div>

        
        <?php elseif(auth()->user()->hasRole('comptable')): ?>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('apprenants.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="<?php echo e(route('statistics.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
            </div>

        
        <?php elseif(auth()->user()->hasRole('surveillant_general')): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Absences</p>
                        <p class="text-3xl font-bold text-red-600"><?php echo e(\App\Models\Absence::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Apprenant::count()); ?></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Classes</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo e(\App\Models\Classe::count()); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('absences.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="<?php echo e(route('apprenants.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="<?php echo e(route('classes.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>📚 Classes</span>
                    </a>
                    <a href="<?php echo e(route('statistics.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
            </div>

        
        <?php else: ?>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Bienvenue</h2>
                <p class="text-gray-600 dark:text-gray-400">Vous êtes connecté en tant que <strong><?php echo e(implode(', ', auth()->user()->roles->pluck('name')->toArray())); ?></strong></p>
                <p class="text-gray-600 dark:text-gray-400 mt-4">Accédez aux différentes sections via le menu de navigation.</p>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/dashboard.blade.php ENDPATH**/ ?>