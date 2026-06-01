<?php
// Script pour copier le logo
$source = 'C:\xampp\htdocs\gestion-bulletin-cpet\WhatsApp Image 2026-04-07 at 11.14.19.jpeg';
$destination = 'C:\xampp\htdocs\gestion-bulletin-cpet\public\images\logo.jpeg';

if (file_exists($source)) {
    if (copy($source, $destination)) {
        echo "✓ Logo copié avec succès vers: " . $destination . PHP_EOL;
    } else {
        echo "✗ Erreur: Impossible de copier le fichier" . PHP_EOL;
    }
} else {
    echo "✗ Erreur: Fichier source introuvable" . PHP_EOL;
}
?>
