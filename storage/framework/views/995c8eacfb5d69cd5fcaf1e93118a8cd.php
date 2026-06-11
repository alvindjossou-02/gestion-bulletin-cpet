<?php $__env->startSection('title', 'Ajouter Note - Gestion Bulletin CPET'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Ajouter une Note</h1>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('notes.store')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Filière Selection -->
                    <div>
                        <label for="filiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filière</label>
                        <select name="filiere_id" id="filiere_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Sélectionner une filière --</option>
                            <?php $__currentLoopData = $filieres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filiere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($filiere->id); ?>" <?php echo e(old('filiere_id') == $filiere->id ? 'selected' : ''); ?>>
                                    <?php echo e($filiere->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Classe Selection -->
                    <div>
                        <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Classe</label>
                        <select name="classe_id" id="classe_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
                            <option value="">-- Sélectionner une classe --</option>
                        </select>
                    </div>

                    <!-- Apprenant Selection -->
                    <div>
                        <label for="apprenant_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Apprenant</label>
                        <select name="apprenant_id" id="apprenant_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required disabled>
                            <option value="">-- Sélectionner un apprenant --</option>
                        </select>
                    </div>

                    <!-- Matière Selection -->
                    <div>
                        <label for="matiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Matière</label>
                        <select name="matiere_id" id="matiere_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required disabled>
                            <option value="">-- Sélectionner une matière --</option>
                            <?php $__currentLoopData = $matieres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matiere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($matiere->id); ?>" <?php echo e(old('matiere_id') == $matiere->id ? 'selected' : ''); ?>>
                                    <?php echo e($matiere->nom_matiere); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Type d'Evaluation -->
                    <div>
                        <label for="type_evaluation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type d'Évaluation</label>
                        <select name="type_evaluation" id="type_evaluation" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- Sélectionner un type --</option>
                            <option value="Devoir" <?php echo e(old('type_evaluation') == 'Devoir' ? 'selected' : ''); ?>>Devoir</option>
                            <option value="Interrogation" <?php echo e(old('type_evaluation') == 'Interrogation' ? 'selected' : ''); ?>>Interrogation</option>
                            <option value="Examen" <?php echo e(old('type_evaluation') == 'Examen' ? 'selected' : ''); ?>>Examen</option>
                            <option value="Contrôle" <?php echo e(old('type_evaluation') == 'Contrôle' ? 'selected' : ''); ?>>Contrôle</option>
                        </select>
                    </div>

                    <!-- Note Value -->
                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Note (0-20)</label>
                        <input type="number" name="note" id="note" min="0" max="20" step="0.5" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required value="<?php echo e(old('note')); ?>">
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-6">
                        <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition">
                            Enregistrer
                        </button>
                        <a href="<?php echo e(route('notes.index')); ?>" class="flex-1 px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition text-center">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Charger tous les apprenants avec leurs relations
    const apprenants = <?php echo json_encode(\App\Models\Apprenant::with(['filiere', 'classe'])->get()); ?>;
    
    // Restructurer les données pour les filtres en cascade
    const filieresData = {};
    apprenants.forEach(apprenant => {
        const filiere_id = apprenant.filiere_id;
        const classe_id = apprenant.classe_id;
        
        if (!filieresData[filiere_id]) {
            filieresData[filiere_id] = {
                id: filiere_id,
                nom_filiere: apprenant.filiere ? apprenant.filiere.nom_filiere : 'N/A',
                classes: {}
            };
        }
        
        if (!filieresData[filiere_id].classes[classe_id]) {
            filieresData[filiere_id].classes[classe_id] = {
                id: classe_id,
                nom_classe: apprenant.classe ? apprenant.classe.nom_classe : 'N/A',
                apprenants: []
            };
        }
        
        // Ajouter l'apprenant à la classe
        filieresData[filiere_id].classes[classe_id].apprenants.push(apprenant);
    });
    
    // Convertir les objets en tableaux
    Object.keys(filieresData).forEach(filiereId => {
        filieresData[filiereId].classes = Object.values(filieresData[filiereId].classes);
    });
    
    const filiereSelect = document.getElementById('filiere_id');
    const classeSelect = document.getElementById('classe_id');
    const apprenantSelect = document.getElementById('apprenant_id');
    const matiereSelect = document.getElementById('matiere_id');

    // Filière change event
    filiereSelect.addEventListener('change', function() {
        classeSelect.innerHTML = '<option value="">-- Sélectionner une classe --</option>';
        apprenantSelect.innerHTML = '<option value="">-- Sélectionner un apprenant --</option>';
        classeSelect.disabled = !this.value;
        apprenantSelect.disabled = true;
        matiereSelect.disabled = true;

        if (this.value) {
            const filiere = filieresData[this.value];
            if (filiere && filiere.classes) {
                filiere.classes.forEach(classe => {
                    const option = document.createElement('option');
                    option.value = classe.id;
                    option.textContent = classe.nom;
                    classeSelect.appendChild(option);
                });
            }
        }
    });

    // Classe change event
    classeSelect.addEventListener('change', function() {
        apprenantSelect.innerHTML = '<option value="">-- Sélectionner un apprenant --</option>';
        apprenantSelect.disabled = !this.value;
        matiereSelect.disabled = false;

        if (this.value) {
            const filiereId = filiereSelect.value;
            const filiere = filieresData[filiereId];
            
            filiere.classes.forEach(classe => {
                if (classe.id == this.value && classe.apprenants) {
                    classe.apprenants.forEach(apprenant => {
                        const option = document.createElement('option');
                        option.value = apprenant.id;
                        option.textContent = apprenant.nom + ' ' + apprenant.prenom;
                        apprenantSelect.appendChild(option);
                    });
                }
            });
        }
    });
</script>

<style>
    input:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/notes/create.blade.php ENDPATH**/ ?>