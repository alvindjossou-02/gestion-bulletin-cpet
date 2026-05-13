<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ROUTES ADMINISTRATEUR & DIRECTEUR ====================
Route::middleware(['auth', 'verified', 'role:administrateur,directeur'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Gestion des utilisateurs
        Route::resource('users', UserRoleController::class);
        Route::post('users/{user}/assign-role', [UserRoleController::class, 'assignRole'])->name('users.assign-role');
        Route::delete('users/{user}/remove-role/{role}', [UserRoleController::class, 'removeRole'])->name('users.remove-role');
    });

    // Gestion des classes
    Route::resource('classes', ClasseController::class);

    // Gestion des filières
    Route::resource('filieres', FiliereController::class);

    // Gestion des apprenants
    Route::resource('apprenants', ApprenantController::class);
});

// ==================== ROUTES GESTION APPRENANTS (Secrétaire, Surveillant, Directeur) ====================
Route::middleware(['auth', 'verified', 'permission:gerer_apprenants'])->group(function () {
    Route::resource('apprenants', ApprenantController::class)->except(['index', 'show', 'edit', 'update', 'destroy']);
});

// ==================== ROUTES SAISIE DES NOTES ====================
Route::middleware(['auth', 'verified', 'permission:saisir_notes'])->group(function () {
    Route::prefix('notes')->name('notes.')->group(function () {
        Route::get('/', [NoteController::class, 'index'])->name('index');
        Route::get('create', [NoteController::class, 'create'])->name('create');
        Route::post('/', [NoteController::class, 'store'])->name('store');
        Route::get('{note}/edit', [NoteController::class, 'edit'])->name('edit');
        Route::patch('{note}', [NoteController::class, 'update'])->name('update');
        Route::delete('{note}', [NoteController::class, 'destroy'])->name('destroy');
        Route::get('apprenant/{apprenant}', [NoteController::class, 'show'])->name('apprenant');
    });
});

// ==================== ROUTES CONSULTATION PROPRES NOTES (Apprenants) ====================
Route::middleware(['auth', 'verified', 'permission:consulter_propres_notes'])->group(function () {
    Route::prefix('my-notes')->name('my-notes.')->group(function () {
        Route::get('/', [NoteController::class, 'myNotes'])->name('index');
    });
});

// ==================== ROUTES BULLETINS ====================
Route::middleware(['auth', 'verified', 'permission:generer_bulletins_pdf'])->group(function () {
    Route::prefix('bulletins')->name('bulletins.')->group(function () {
        Route::get('/', [BulletinController::class, 'index'])->name('index');
        Route::get('create', [BulletinController::class, 'create'])->name('create');
        Route::post('/', [BulletinController::class, 'store'])->name('store');
        Route::get('{bulletin}', [BulletinController::class, 'show'])->name('show');
        Route::get('{bulletin}/edit', [BulletinController::class, 'edit'])->name('edit');
        Route::patch('{bulletin}', [BulletinController::class, 'update'])->name('update');
        Route::delete('{bulletin}', [BulletinController::class, 'destroy'])->name('destroy');
        Route::get('{bulletin}/pdf', [BulletinController::class, 'downloadPDF'])->name('pdf');
    });
});

// ==================== ROUTES STATISTIQUES ====================
Route::middleware(['auth', 'verified', 'permission:consulter_statistiques'])->group(function () {
    Route::prefix('statistics')->name('statistics.')->group(function () {
        Route::get('/', [StatisticsController::class, 'index'])->name('index');
        Route::get('classe/{classe}', [StatisticsController::class, 'classReport'])->name('class-report');
        Route::get('filiere/{filiere}', [StatisticsController::class, 'filiereReport'])->name('filiere-report');
    });
});

// ==================== ROUTES ENREGISTREMENT ABSENCES ====================
Route::middleware(['auth', 'verified', 'permission:enregistrer_absences'])->group(function () {
    Route::prefix('absences')->name('absences.')->group(function () {
        // À implémenter: Route::resource('absences', AbsenceController::class);
    });
});

require __DIR__.'/auth.php';
