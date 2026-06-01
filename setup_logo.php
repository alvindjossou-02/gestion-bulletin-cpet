<?php
/**
 * Logo Setup Script
 * Utilisation: php setup_logo.php
 */

// Déterminer les chemins
$projectRoot = __DIR__;
$sourcePath = $projectRoot . DIRECTORY_SEPARATOR . 'WhatsApp Image 2026-04-07 at 11.14.19.jpeg';
$destDir = $projectRoot . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images';
$destPath = $destDir . DIRECTORY_SEPARATOR . 'logo.jpeg';

// Créer le répertoire s'il n'existe pas
if (!is_dir($destDir)) {
    if (!mkdir($destDir, 0755, true)) {
        echo "✗ Erreur: Impossible de créer le répertoire " . $destDir . "\n";
        exit(1);
    }
}

// Copier le fichier
if (file_exists($sourcePath)) {
    if (copy($sourcePath, $destPath)) {
        echo "✓ Logo copié avec succès!\n";
        echo "  Source: " . $sourcePath . "\n";
        echo "  Destination: " . $destPath . "\n";
        exit(0);
    } else {
        echo "✗ Erreur lors de la copie du logo\n";
        exit(1);
    }
} else {
    echo "✗ Fichier source introuvable: " . $sourcePath . "\n";
    echo "\nFichiers disponibles:\n";
    $files = glob($projectRoot . DIRECTORY_SEPARATOR . 'WhatsApp*');
    if (empty($files)) {
        echo "  Aucun fichier 'WhatsApp' trouvé\n";
    } else {
        foreach ($files as $file) {
            echo "  - " . basename($file) . "\n";
        }
    }
    exit(1);
}
?>
