# ⚡ QUICK INSTALL - Stack complète

## Installation des packages manquants (3 min)

### 1️⃣ Export PDF
```bash
composer require barryvdh/laravel-dompdf:^3.0
```

**Vérification:**
```bash
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

### 2️⃣ Export Excel
```bash
composer require maatwebsite/excel:^3.1
```

**Vérification:**
```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### 3️⃣ Charts JavaScript
```bash
npm install chart.js@4.4.0 axios
npm run build
```

---

## Après installation - Vérification ✅

```bash
# Vérifier Composer packages
composer show | grep -E "(dompdf|excel)"

# Vérifier NPM packages
npm list chart.js

# Vérifier Laravel config
php artisan config:cache
php artisan view:cache

# Tester l'app
php artisan serve
```

---

## Stack Installé Définitif

```json
{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/tinker": "^2.10.1",
    "spatie/laravel-permission": "^6.25",
    "barryvdh/laravel-dompdf": "^3.0",              ✅ AJOUTÉ
    "maatwebsite/excel": "^3.1"                      ✅ AJOUTÉ
  },
  "require-dev": {
    "fakerphp/faker": "^1.23",
    "laravel/breeze": "^2.4",
    "laravel/pail": "^1.2.2",
    "laravel/pint": "^1.24",
    "laravel/sail": "^1.41",
    "mockery/mockery": "^1.6",
    "nunomaduro/collision": "^8.6",
    "pestphp/pest": "^3.8",
    "pestphp/pest-plugin-laravel": "^3.2"
  }
}
```

```json
{
  "devDependencies": {
    "@tailwindcss/forms": "^0.5.2",
    "@tailwindcss/vite": "^4.0.0",
    "alpinejs": "^3.4.2",
    "autoprefixer": "^10.4.2",
    "axios": "^1.11.0",
    "chart.js": "^4.4.0",                           ✅ AJOUTÉ
    "concurrently": "^9.0.1",
    "laravel-vite-plugin": "^2.0.0",
    "postcss": "^8.4.31",
    "tailwindcss": "^3.1.0",
    "vite": "^7.0.7"
  }
}
```

---

## Configuration minimale après install

### Pour dompdf (PDF)
En `config/app.php`:
```php
'providers' => [
    // ...
    Barryvdh\DomPDF\ServiceProvider::class,
],

'aliases' => [
    // ...
    'PDF' => Barryvdh\DomPDF\Facade\Pdf::class,
],
```

### Pour excel (Excel)
En `config/app.php`:
```php
'providers' => [
    // ...
    Maatwebsite\Excel\ExcelServiceProvider::class,
],

'aliases' => [
    // ...
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,
],
```

---

## Utilisation rapide

### Générer PDF bulletin
```php
// app/Http/Controllers/BulletinController.php

use PDF;

public function downloadPDF(Bulletin $bulletin)
{
    $data = ['bulletin' => $bulletin];
    return PDF::loadView('bulletins.pdf', $data)
        ->download('bulletin_'.$bulletin->apprenant->matricule.'.pdf');
}
```

### Exporter Excel
```php
// app/Http/Controllers/ApprenantController.php

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApprenantsExport;

public function export()
{
    return Excel::download(
        new ApprenantsExport,
        'apprenants_'.date('Y_m_d').'.xlsx'
    );
}
```

### Afficher Chart
```javascript
// resources/js/chart.js

import Chart from 'chart.js/auto';

const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
            label: 'Notes Moyennes',
            data: [12, 19, 3],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    }
});
```

---

## Version finale du projet

**Après ces installations, vous aurez:**

✅ Framework complet Laravel 12
✅ Base de données MySQL avec 18 tables
✅ Authentification & Authorization (Breeze + Spatie)
✅ Export PDF professionnel (dompdf)
✅ Export Excel/CSV (laravel-excel)
✅ Graphiques dynamiques (chart.js)
✅ UI moderne (Tailwind + Alpine)
✅ Testing framework (Pest)
✅ Audit logging (AuditService)
✅ Système complet de gestion bulletins

---

## Prochaines étapes (Roadmap)

1. **Créer Form Requests** (validation côté serveur)
2. **Écrire Tests** (Pest)
3. **Créer Seeders** (données fictives)
4. **Implémenter filtres/pagination** (listes)
5. **Afficher statistiques** avec Chart.js
6. **Finaliser audit logging**

---

**Total installation: 5 minutes**
**Total configuration: 10 minutes**
**Ready to code: 15 minutes**

🚀 Go-live ready!
