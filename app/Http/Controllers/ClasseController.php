<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Afficher la liste des classes
     */
    public function index()
    {
        $classes = Classe::with('apprenants')->paginate(15);
        return view('classes.index', compact('classes'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Stocker une nouvelle classe
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_classe' => 'required|string|max:255|unique:classes',
        ]);

        Classe::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe créée avec succès!');
    }

    /**
     * Afficher les détails d'une classe
     */
    public function show(Classe $classe)
    {
        return view('classes.show', compact('classe'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    /**
     * Mettre à jour une classe
     */
    public function update(Request $request, Classe $classe)
    {
        $validated = $request->validate([
            'nom_classe' => 'required|string|max:255|unique:classes,nom_classe,' . $classe->id,
        ]);

        $classe->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe mise à jour avec succès!');
    }

    /**
     * Supprimer une classe
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Classe supprimée avec succès!');
    }
}
