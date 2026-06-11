# Guide de Nommage des Routes - Prévention des Erreurs

## Objectif
Ce guide assure que toutes les routes sont correctement nommées et référencées dans les vues Blade pour éviter les erreurs "Route not defined".

## Convention de Nommage des Routes

### ✅ STANDARD ACCEPTÉ: Hyphens (tirets)
```php
// ✅ CORRECT: Utiliser des tirets pour séparer les mots
Route::get('admin/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
Route::get('my-notes', [NoteController::class, 'myNotes'])->name('my-notes.index');

// Dans les vues Blade:
<a href="{{ route('audit-logs.index') }}">Journaux</a>
<a href="{{ route('my-notes.index') }}">Mes Notes</a>
```

### ❌ À ÉVITER: Dots (points)
```php
// ❌ INCORRECT: Ne pas utiliser des points pour séparer les mots
route('audit.logs')        // ❌ ERREUR
route('my.notes')          // ❌ ERREUR
route('user.profile')      // ❌ ERREUR
```

### Points (dots): Seulement pour Préfixe + Ressource
```php
// ✅ CORRECT: Points uniquement pour préfixe + nom de ressource
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserRoleController::class);
    // Crée automatiquement: admin.users.index, admin.users.create, etc.
});

// ✅ Utilisation correcte:
route('admin.users.index')    // ✅ OK
route('admin.users.create')   // ✅ OK
route('admin.users.store')    // ✅ OK
```

## Liste Complète des Routes Validées

### Routes d'Authentification (routes/auth.php)
| Route Name | Endpoint | Utilisé? |
|-----------|----------|----------|
| `login` | GET /login | ✅ |
| `register` | GET /register | ✅ |
| `verification.send` | POST /email/verification-notification | ✅ |
| `verification.notice` | GET /verify-email | ✅ |
| `verification.verify` | GET /verify-email/{id}/{hash} | ✅ |
| `password.request` | GET /forgot-password | Non utilisée |
| `password.email` | POST /forgot-password | Non utilisée |
| `password.reset` | GET /reset-password/{token} | Non utilisée |
| `password.store` | POST /reset-password | Non utilisée |
| `password.update` | PUT /password | ✅ |
| `password.confirm` | GET /confirm-password | Non utilisée |
| `logout` | POST /logout | ✅ |

### Routes de Gestion (routes/web.php)

#### Apprenants
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `apprenants.index` | GET /apprenants | permission:gerer_apprenants | ✅ |
| `apprenants.create` | GET /apprenants/create | permission:gerer_apprenants | Non |
| `apprenants.store` | POST /apprenants | permission:gerer_apprenants | Non |
| `apprenants.show` | GET /apprenants/{apprenant} | permission:gerer_apprenants | Non |
| `apprenants.edit` | GET /apprenants/{apprenant}/edit | permission:gerer_apprenants | Non |
| `apprenants.update` | PATCH /apprenants/{apprenant} | permission:gerer_apprenants | Non |
| `apprenants.destroy` | DELETE /apprenants/{apprenant} | permission:gerer_apprenants | Non |

#### Classes
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `classes.index` | GET /classes | permission:gerer_classes_filieres | ✅ |
| `classes.create` | GET /classes/create | permission:gerer_classes_filieres | ✅ |
| `classes.store` | POST /classes | permission:gerer_classes_filieres | Non |
| `classes.show` | GET /classes/{classe} | permission:gerer_classes_filieres | Non |
| `classes.edit` | GET /classes/{classe}/edit | permission:gerer_classes_filieres | ✅ |
| `classes.update` | PATCH /classes/{classe} | permission:gerer_classes_filieres | Non |
| `classes.destroy` | DELETE /classes/{classe} | permission:gerer_classes_filieres | Non |

#### Filières
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `filieres.index` | GET /filieres | permission:gerer_classes_filieres | ✅ |
| `filieres.create` | GET /filieres/create | permission:gerer_classes_filieres | ✅ |
| `filieres.store` | POST /filieres | permission:gerer_classes_filieres | Non |
| `filieres.show` | GET /filieres/{filiere} | permission:gerer_classes_filieres | Non |
| `filieres.edit` | GET /filieres/{filiere}/edit | permission:gerer_classes_filieres | ✅ |
| `filieres.update` | PATCH /filieres/{filiere} | permission:gerer_classes_filieres | Non |
| `filieres.destroy` | DELETE /filieres/{filiere} | permission:gerer_classes_filieres | Non |

#### Matières
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `matieres.index` | GET /matieres | permission:gerer_classes_filieres | ✅ |
| `matieres.create` | GET /matieres/create | permission:gerer_classes_filieres | Non |
| `matieres.store` | POST /matieres | permission:gerer_classes_filieres | Non |
| `matieres.show` | GET /matieres/{matiere} | permission:gerer_classes_filieres | Non |
| `matieres.edit` | GET /matieres/{matiere}/edit | permission:gerer_classes_filieres | Non |
| `matieres.update` | PATCH /matieres/{matiere} | permission:gerer_classes_filieres | Non |
| `matieres.destroy` | DELETE /matieres/{matiere} | permission:gerer_classes_filieres | Non |

#### Notes
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `notes.index` | GET /notes | permission:saisir_notes | ✅ |
| `notes.create` | GET /notes/create | permission:saisir_notes | ✅ |
| `notes.store` | POST /notes | permission:saisir_notes | Non |
| `notes.edit` | GET /notes/{note}/edit | permission:saisir_notes | Non |
| `notes.update` | PATCH /notes/{note} | permission:saisir_notes | Non |
| `notes.destroy` | DELETE /notes/{note} | permission:saisir_notes | Non |
| `notes.apprenant` | GET /notes/apprenant/{apprenant} | permission:saisir_notes | Non |

#### Mes Notes (Apprenants seulement)
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `my-notes.index` | GET /my-notes | permission:consulter_propres_notes | ✅ |

#### Bulletins
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `bulletins.index` | GET /bulletins | role:admin,directeur,directrice,enseignant,surveill... | ✅ |
| `bulletins.create` | GET /bulletins/create | role:admin,directeur,directrice,enseignant,surveill... | ✅ |
| `bulletins.store` | POST /bulletins | role:admin,directeur,directrice,enseignant,surveill... | Non |
| `bulletins.show` | GET /bulletins/{bulletin} | role:admin,directeur,directrice,enseignant,surveill... | Non |
| `bulletins.edit` | GET /bulletins/{bulletin}/edit | role:admin,directeur,directrice,enseignant,surveill... | Non |
| `bulletins.update` | PATCH /bulletins/{bulletin} | role:admin,directeur,directrice,enseignant,surveill... | Non |
| `bulletins.destroy` | DELETE /bulletins/{bulletin} | role:admin,directeur,directrice,enseignant,surveill... | Non |
| `bulletins.pdf` | GET /bulletins/{bulletin}/pdf | role:admin,directeur,directrice,enseignant,surveill... | ✅ |

#### Statistiques
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `statistics.index` | GET /statistics | permission:consulter_statistiques | ✅ |
| `statistics.class-report` | GET /statistics/classe/{classe} | permission:consulter_statistiques | Non |
| `statistics.filiere-report` | GET /statistics/filiere/{filiere} | permission:consulter_statistiques | Non |

#### Absences
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `absences.index` | GET /absences | permission:enregistrer_absences | ✅ |
| `absences.create` | GET /absences/create | permission:enregistrer_absences | Non |
| `absences.store` | POST /absences | permission:enregistrer_absences | Non |
| `absences.show` | GET /absences/{absence} | permission:enregistrer_absences | Non |
| `absences.edit` | GET /absences/{absence}/edit | permission:enregistrer_absences | Non |
| `absences.update` | PATCH /absences/{absence} | permission:enregistrer_absences | Non |
| `absences.destroy` | DELETE /absences/{absence} | permission:enregistrer_absences | Non |

#### Utilisateurs (Admin)
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `admin.users.index` | GET /admin/users | role:administrateur,directeur,directrice | ✅ |
| `admin.users.create` | GET /admin/users/create | role:administrateur,directeur,directrice | Non |
| `admin.users.store` | POST /admin/users | role:administrateur,directeur,directrice | Non |
| `admin.users.show` | GET /admin/users/{user} | role:administrateur,directeur,directrice | Non |
| `admin.users.edit` | GET /admin/users/{user}/edit | role:administrateur,directeur,directrice | Non |
| `admin.users.update` | PATCH /admin/users/{user} | role:administrateur,directeur,directrice | Non |
| `admin.users.destroy` | DELETE /admin/users/{user} | role:administrateur,directeur,directrice | Non |

#### Routes Additionnelles (Admin)
| Route Name | Endpoint | Middleware |
|-----------|----------|-----------|
| `admin.users.assign-role` | POST /admin/users/{user}/assign-role | role:administrateur,directeur,directrice |
| `admin.users.remove-role` | DELETE /admin/users/{user}/remove-role/{role} | role:administrateur,directeur,directrice |

#### Journaux d'Audit
| Route Name | Endpoint | Middleware | Utilisé? |
|-----------|----------|-----------|----------|
| `audit-logs.index` | GET /admin/audit-logs | role:administrateur,directeur,directrice | ✅ |
| `audit-logs.show` | GET /admin/audit-logs/{auditLog} | role:administrateur,directeur,directrice | Non |
| `audit-logs.export` | GET /admin/audit-logs/export | role:administrateur,directeur,directrice | Non |

## Erreurs Corrigées

### 1. Dashboard Audit Logs (FIXED ✅)
**Fichier**: resources/views/dashboard.blade.php  
**Erreur**: `route('audit.logs')` → Route not defined  
**Fix**: Changed to `route('audit-logs.index')`  
**Status**: ✅ VERIFIED

## Checklist de Validation des Routes

Avant de lancer une nouvelle feature:

- [ ] Vérifier que la route est définie dans routes/web.php ou routes/auth.php
- [ ] Utiliser des tirets (hyphens) pour les noms multi-mots: `audit-logs`, `my-notes`
- [ ] Utiliser des points uniquement pour préfixe.ressource: `admin.users.index`
- [ ] Vérifier le middleware/permission requis
- [ ] Tester la route en navigateur
- [ ] Committer avec message: "Fix route naming: {old} → {new}"

## Outils de Vérification

### Commande pour lister toutes les routes
```bash
php artisan route:list
```

### Commande pour vérifier une route existe
```bash
php artisan route:list | grep 'audit-logs'
```

### Grep pour toutes les utilisations de routes dans les vues
```bash
grep -r "route(" resources/views --include="*.blade.php"
```

## Contact et Support

Pour signaler une erreur de route manquante:
1. Lancer `php artisan route:list`
2. Vérifier que la route est dans la liste
3. Corriger le nom dans la vue (suivre convention hyphens/dots)
4. Tester en navigateur
