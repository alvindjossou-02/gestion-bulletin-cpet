<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Afficher la liste des filières
     */
    public function index()
    {
        $filieres = Filiere::with(['apprenants', 'matieres'])->paginate(15);
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('filieres.create');
    }

    /**
     * Stocker une nouvelle filière
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_filiere' => 'required|string|max:255|unique:filieres',
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')
            ->with('success', 'Filière créée avec succès!');
    }

    /**
     * Afficher les détails d'une filière
     */
    public function show(Filiere $filiere)
    {
        return view('filieres.show', compact('filiere'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));
    }

    /**
     * Mettre à jour une filière
     */
    public function update(Request $request, Filiere $filiere)
    {
        $validated = $request->validate([
            'nom_filiere' => 'required|string|max:255|unique:filieres,nom_filiere,' . $filiere->id,
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')
            ->with('success', 'Filière mise à jour avec succès!');
    }

    /**
     * Supprimer une filière
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('filieres.index')
            ->with('success', 'Filière supprimée avec succès!');
    }
}
