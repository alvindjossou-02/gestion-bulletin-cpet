<?php

namespace App\Http\Controllers;

use App\Mail\AbsenceRecorded;
use App\Models\Absence;
use App\Models\Apprenant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $filieres = Filiere::all();
        return view('absences.create', compact('apprenants', 'filieres'));
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
        $absence = Absence::create($validated);

        // Charger les relations pour l'email
        $absence = $absence->load('apprenant.classe.filiere');

        // Envoyer un email de notification à l'apprenant
        if ($absence->apprenant->user) {
            Mail::queue(new AbsenceRecorded($absence));
        }

        return redirect()->route('absences.index')->with('success', 'Absence enregistrée avec succès! Un email de notification a été envoyé.');
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
