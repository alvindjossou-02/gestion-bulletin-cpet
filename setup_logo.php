<?php
/**
 * Logo Migration Helper
 * Exécutez: php artisan tinker < setup_logo.php
 */

$sourcePath = base_path('WhatsApp Image 2026-04-07 at 11.14.19.jpeg');
$destPath = public_path('images/logo.jpeg');

if (file_exists($sourcePath)) {
    if (!is_dir(dirname($destPath))) {
        mkdir(dirname($destPath), 0755, true);
    }
    
    if (copy($sourcePath, $destPath)) {
        echo "✓ Logo copié avec succès!\n";
    } else {
        echo "✗ Erreur lors de la copie du logo\n";
    }
} else {
    echo "✗ Fichier source introuvable: " . $sourcePath . "\n";
}
?>
