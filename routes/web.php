<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ROUTES ADMINISTRATEUR & DIRECTRICE ====================
Route::middleware(['auth', 'verified', 'role:administrateur,directeur,directrice'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserRoleController::class);
    Route::post('users/{user}/assign-role', [UserRoleController::class, 'assignRole'])->name('users.assign-role');
    Route::delete('users/{user}/remove-role/{role}', [UserRoleController::class, 'removeRole'])->name('users.remove-role');
});

// ==================== ROUTES GESTIONCLASSES/ FILIERES ====================
Route::middleware(['auth', 'verified', 'permission:gerer_classes_filieres'])->group(function () {
    Route::resource('classes', ClasseController::class);
    Route::resource('filieres', FiliereController::class);
    Route::resource('matieres', MatiereController::class);
});

// ==================== ROUTES GESTION DES APPRENANTS ====================
Route::middleware(['auth', 'verified', 'permission:gerer_apprenants'])->group(function () {
    Route::resource('apprenants', ApprenantController::class);
});

// ==================== ROUTES SAISIE DES NOTES ====================
Route::middleware(['auth', 'verified', 'permission:saisir_notes'])->prefix('notes')->name('notes.')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('index');
    Route::get('create', [NoteController::class, 'create'])->name('create');
    Route::post('/', [NoteController::class, 'store'])->name('store');
    Route::get('{note}/edit', [NoteController::class, 'edit'])->name('edit');
    Route::patch('{note}', [NoteController::class, 'update'])->name('update');
    Route::delete('{note}', [NoteController::class, 'destroy'])->name('destroy');
    Route::get('apprenant/{apprenant}', [NoteController::class, 'show'])->name('apprenant');
});

// ==================== ROUTES CONSULTATION PROPRES NOTES (Apprenants) ====================
Route::middleware(['auth', 'verified', 'permission:consulter_propres_notes'])->prefix('my-notes')->name('my-notes.')->group(function () {
    Route::get('/', [NoteController::class, 'myNotes'])->name('index');
});

// ==================== ROUTES BULLETINS ====================
Route::middleware(['auth', 'verified', 'role:administrateur,directeur,directrice,enseignant,surveillant_general'])->prefix('bulletins')->name('bulletins.')->group(function () {
    Route::get('/', [BulletinController::class, 'index'])->name('index');
    Route::get('create', [BulletinController::class, 'create'])->name('create');
    Route::post('/', [BulletinController::class, 'store'])->name('store');
    Route::get('{bulletin}', [BulletinController::class, 'show'])->name('show');
    Route::get('{bulletin}/edit', [BulletinController::class, 'edit'])->name('edit');
    Route::patch('{bulletin}', [BulletinController::class, 'update'])->name('update');
    Route::delete('{bulletin}', [BulletinController::class, 'destroy'])->name('destroy');
    Route::get('{bulletin}/pdf', [BulletinController::class, 'downloadPDF'])->name('pdf');
});

// ==================== ROUTES STATISTIQUES ====================
Route::middleware(['auth', 'verified', 'permission:consulter_statistiques'])->prefix('statistics')->name('statistics.')->group(function () {
    Route::get('/', [StatisticsController::class, 'index'])->name('index');
    Route::get('classe/{classe}', [StatisticsController::class, 'classReport'])->name('class-report');
    Route::get('filiere/{filiere}', [StatisticsController::class, 'filiereReport'])->name('filiere-report');
});

// ==================== ROUTES ENREGISTREMENT ABSENCES ====================
Route::middleware(['auth', 'verified', 'permission:enregistrer_absences'])->group(function () {
    Route::resource('absences', AbsenceController::class);
});

// ==================== ROUTES JOURNAUX D'AUDIT ====================
Route::middleware(['auth', 'verified', 'role:administrateur,directeur,directrice'])->group(function () {
    Route::get('admin/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    Route::get('admin/audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit-logs.show');
    Route::get('admin/audit-logs/export', [AuditLogController::class, 'export'])->name('audit-logs.export');
});

require __DIR__.'/auth.php';
