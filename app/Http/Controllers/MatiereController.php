<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Classe;
use App\Models\Matiere;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with(['filiere', 'classe'])->paginate(15);
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $classes = Classe::all();
        return view('matieres.create', compact('filieres', 'classes'));
    }

    public function store(StoreMatiereRequest $request)
    {
        $validated = $request->validated();

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
        $classes = Classe::all();
        return view('matieres.edit', compact('matiere', 'filieres', 'classes'));
    }

    public function update(UpdateMatiereRequest $request, Matiere $matiere)
    {
        $validated = $request->validated();

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
