<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Apprenant;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('apprenant')->orderByDesc('date_absence')->paginate(20);
        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        $apprenants = Apprenant::orderBy('nom')->get();
        return view('absences.create', compact('apprenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'date_absence' => 'required|date',
            'justifiee' => 'sometimes|boolean',
            'motif' => 'nullable|string|max:255',
        ]);
        $validated['justifiee'] = $request->has('justifiee');
        Absence::create($validated);
        return redirect()->route('absences.index')->with('success', 'Absence enregistrée avec succès!');
    }

    public function edit(Absence $absence)
    {
        $apprenants = Apprenant::orderBy('nom')->get();
        return view('absences.edit', compact('absence', 'apprenants'));
    }

    public function update(Request $request, Absence $absence)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'date_absence' => 'required|date',
            'justifiee' => 'sometimes|boolean',
            'motif' => 'nullable|string|max:255',
        ]);
        $validated['justifiee'] = $request->has('justifiee');
        $absence->update($validated);
        return redirect()->route('absences.index')->with('success', 'Absence modifiée avec succès!');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('absences.index')->with('success', 'Absence supprimée avec succès!');
    }
}
