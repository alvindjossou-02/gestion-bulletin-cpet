<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with('filiere')->paginate(15);
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('matieres.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres',
            'coefficient' => 'required|integer|min:1|max:10',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière créée avec succès!');
    }

    public function show(Matiere $matiere)
    {
        return view('matieres.show', compact('matiere'));
    }

    public function edit(Matiere $matiere)
    {
        $filieres = Filiere::all();
        return view('matieres.edit', compact('matiere', 'filieres'));
    }

    public function update(Request $request, Matiere $matiere)
    {
        $validated = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres,nom_matiere,' . $matiere->id,
            'coefficient' => 'required|integer|min:1|max:10',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $matiere->update($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès!');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès!');
    }
}
