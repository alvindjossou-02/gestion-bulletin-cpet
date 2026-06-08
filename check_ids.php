<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== FILIÈRES ===\n";
$filieres = DB::table('filieres')->get(['id', 'nom_filiere']);
foreach($filieres as $f) {
    echo $f->id . ': ' . $f->nom_filiere . "\n";
}

echo "\n=== CLASSES ===\n";
$classes = DB::table('classes')->get(['id', 'nom_classe']);
foreach($classes as $c) {
    echo $c->id . ': ' . $c->nom_classe . "\n";
}
