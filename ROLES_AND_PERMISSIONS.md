# Système de Rôles et Permissions - Gestion de Bulletins CPET

## 📋 Vue d'ensemble

Ce système implémente une gestion complète des rôles et permissions basée sur **Spatie Laravel Permission** pour sécuriser l'application selon le tableau fourni.

## 🎭 Les 7 Rôles du Système

### 1. **ADMINISTRATEUR**
- ✅ Gérer les utilisateurs
- ✅ Gérer les classes/filières
- ✅ Gérer les apprenants
- ✅ Saisir les notes
- ✅ Enregistrer les absences
- ✅ Générer les bulletins PDF
- ✅ Consulter les statistiques

### 2. **ENSEIGNANT**
- ✅ Saisir les notes
- ✅ Enregistrer les absences
- ✅ Générer les bulletins PDF
- ❌ Autres accès bloqués

### 3. **APPRENANT**
- ✅ Consulter ses propres notes
- ❌ Autres accès bloqués

### 4. **SECRÉTAIRE**
- ✅ Gérer les classes/filières
- ✅ Gérer les apprenants
- ✅ Saisir les notes
- ✅ Enregistrer les absences
- ✅ Générer les bulletins PDF
- ✅ Consulter les statistiques
- ❌ Gérer les utilisateurs

### 5. **COMPTABLE**
- ✅ Générer les bulletins PDF
- ✅ Consulter les statistiques
- ❌ Autres accès bloqués

### 6. **SURVEILLANT GÉNÉRAL**
- ✅ Gérer les apprenants
- ✅ Saisir les notes
- ✅ Enregistrer les absences
- ✅ Générer les bulletins PDF
- ✅ Consulter les statistiques
- ❌ Gérer les classes/filières

### 7. **DIRECTEUR**
- ✅ Gérer les classes/filières
- ✅ Gérer les apprenants
- ✅ Saisir les notes
- ✅ Enregistrer les absences
- ✅ Générer les bulletins PDF
- ✅ Consulter les statistiques
- ✅ Gérer les utilisateurs

## 🔐 Permissions Disponibles

1. `gerer_utilisateurs` - Gérer les utilisateurs
2. `gerer_classes_filieres` - Gérer les classes et filières
3. `gerer_apprenants` - Gérer les apprenants
4. `saisir_notes` - Saisir les notes
5. `enregistrer_absences` - Enregistrer les absences
6. `consulter_propres_notes` - Consulter ses propres notes (Apprenants)
7. `generer_bulletins_pdf` - Générer les bulletins en PDF
8. `consulter_statistiques` - Consulter les statistiques

## 🛡️ Middlewares de Protection

### Middleware de Rôle: `CheckRole`
```php
Route::middleware(['auth', 'role:administrateur,directeur'])->group(function () {
    // Routes protégées pour Admin et Directeur
});
```

### Middleware de Permission: `CheckPermission`
```php
Route::middleware(['auth', 'permission:saisir_notes'])->group(function () {
    // Routes protégées pour ceux qui ont la permission 'saisir_notes'
});
```

## 📁 Structure des Fichiers Créés

```
app/
├── Http/
│   ├── Controllers/
│   │   └── UserRoleController.php      # Gestion des rôles utilisateurs
│   └── Middleware/
│       ├── CheckRole.php               # Middleware de vérification de rôle
│       └── CheckPermission.php         # Middleware de vérification de permission
├── Models/
│   └── User.php                        # Modèle User avec Spatie traits
│
database/
└── seeders/
    └── RolesAndPermissionsSeeder.php   # Seeder pour créer les rôles et permissions

resources/
└── views/
    └── admin/
        └── users/
            └── index.blade.php         # Interface de gestion des utilisateurs
```

## 🔧 Utilisation dans les Vues Blade

### Vérifier le rôle
```blade
@if(auth()->user()->hasRole('administrateur'))
    <!-- Contenu pour admin -->
@endif

@if(auth()->user()->hasRole(['administrateur', 'directeur']))
    <!-- Contenu pour admin ou directeur -->
@endif
```

### Vérifier la permission
```blade
@if(auth()->user()->hasPermissionTo('saisir_notes'))
    <!-- Contenu pour ceux avec permission 'saisir_notes' -->
@endif
```

### Utiliser les directives Spatie
```blade
@role('administrateur')
    <!-- Contenu pour les admins -->
@endrole

@permission('generer_bulletins_pdf')
    <!-- Contenu pour ceux qui peuvent générer les bulletins -->
@endpermission
```

## 📝 Routes Protégées

### Admin Panel
```
/admin/users               - Liste des utilisateurs (Admin/Directeur)
/admin/users/{id}/roles    - Assigner/retirer des rôles
```

### Notes
```
/notes                     - Saisir notes (Enseignant+)
/my-notes                  - Consulter ses notes (Apprenant)
```

### Bulletins
```
/bulletins                 - Générer bulletins PDF (Multiple rôles)
```

### Statistiques
```
/statistics                - Consulter statistiques (Multiple rôles)
```

## 🚀 Installation et Configuration

### 1. Package installé
```bash
composer require spatie/laravel-permission:^6.25
```

### 2. Tables créées
```bash
php artisan migrate
```

### 3. Rôles et permissions initialisés
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

## 📊 Navigation Conditionnelle

La barre de navigation (`navigation.blade.php`) affiche dynamiquement les menus selon:
- Le rôle de l'utilisateur
- Les permissions disponibles
- Les versions desktop et mobile

## ⚠️ Sécurité

- Tous les contrôleurs critiques sont protégés par middlewares
- Les permissions sont vérifiées au niveau des routes
- Cache de Spatie réinitialisé automatiquement lors du seedage
- Les rôles ne sont assignables que par Admin/Directeur
- Les vues masquent les éléments sans permission

## 🔄 Astuces de Développement

### Assigner un rôle à un utilisateur
```php
$user->assignRole('administrateur');
```

### Retirer un rôle
```php
$user->removeRole('enseignant');
```

### Vérifier directement en PHP
```php
if (auth()->user()->hasRole('administrateur')) {
    // ...
}

if (auth()->user()->hasPermissionTo('saisir_notes')) {
    // ...
}
```

### Créer une nouvelle permission
```php
Permission::create(['name' => 'nouvelle_permission']);
```

## 📞 Support

En cas de problème avec les permissions ou rôles:
1. Vérifier que Spatie Permission est correctement installé
2. Vérifier que les migrations ont été exécutées
3. Vérifier que le seeder a été exécuté
4. Vider le cache: `php artisan cache:clear`
5. Réexécuter le seeder si nécessaire

---

**Système de rôles et permissions complètement fonctionnel et sécurisé ✅**
