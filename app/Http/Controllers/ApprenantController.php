<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use App\Models\Filiere;
use App\Models\Classe;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    /**
     * Afficher la liste des apprenants
     */
    public function index()
    {
        $apprenants = Apprenant::with(['filiere', 'classe'])->paginate(15);
        return view('apprenants.index', compact('apprenants'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $filieres = Filiere::all();
        $classes = Classe::all();
        return view('apprenants.create', compact('filieres', 'classes'));
    }

    /**
     * Stocker un nouvel apprenant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:50|unique:apprenants',
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'filiere_id' => 'required|exists:filieres,id',
            'classe_id' => 'required|exists:classes,id',
            'reboublant' => 'sometimes|boolean',
        ]);

        // Normalize checkbox input (present when checked)
        $validated['reboublant'] = $request->has('reboublant');

        Apprenant::create($validated);

        return redirect()->route('apprenants.index')
            ->with('success', 'Apprenant créé avec succès!');
    }

    /**
     * Afficher les détails d'un apprenant
     */
    public function show(Apprenant $apprenant)
    {
        return view('apprenants.show', compact('apprenant'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Apprenant $apprenant)
    {
        $filieres = Filiere::all();
        $classes = Classe::all();
        return view('apprenants.edit', compact('apprenant', 'filieres', 'classes'));
    }

    /**
     * Mettre à jour un apprenant
     */
    public function update(Request $request, Apprenant $apprenant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:50|unique:apprenants,matricule,' . $apprenant->id,
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'filiere_id' => 'required|exists:filieres,id',
            'classe_id' => 'required|exists:classes,id',
            'reboublant' => 'sometimes|boolean',
        ]);

        $validated['reboublant'] = $request->has('reboublant');

        $apprenant->update($validated);

        return redirect()->route('apprenants.index')
            ->with('success', 'Apprenant mis à jour avec succès!');
    }

    /**
     * Supprimer un apprenant
     */
    public function destroy(Apprenant $apprenant)
    {
        $apprenant->delete();

        return redirect()->route('apprenants.index')
            ->with('success', 'Apprenant supprimé avec succès!');
    }
}
