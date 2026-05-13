<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Apprenant;
use App\Models\Matiere;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Afficher la liste des notes
     */
    public function index()
    {
        $notes = Note::with(['apprenant', 'matiere'])->paginate(20);
        return view('notes.index', compact('notes'));
    }

    /**
     * Afficher le formulaire de saisie
     */
    public function create()
    {
        $apprenants = Apprenant::all();
        $matieres = Matiere::all();
        $typeEvaluations = ['Devoir', 'Test', 'Contrôle', 'Examen', 'Travaux Pratiques'];
        return view('notes.create', compact('apprenants', 'matieres', 'typeEvaluations'));
    }

    /**
     * Stocker une note
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'type_evaluation' => 'required|string|max:50',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        Note::create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note saisie avec succès!');
    }

    /**
     * Afficher les notes d'un apprenant
     */
    public function show(Apprenant $apprenant)
    {
        $notes = $apprenant->notes()->with('matiere')->get();
        return view('notes.show', compact('apprenant', 'notes'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Note $note)
    {
        $apprenants = Apprenant::all();
        $matieres = Matiere::all();
        $typeEvaluations = ['Devoir', 'Test', 'Contrôle', 'Examen', 'Travaux Pratiques'];
        return view('notes.edit', compact('note', 'apprenants', 'matieres', 'typeEvaluations'));
    }

    /**
     * Mettre à jour une note
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'type_evaluation' => 'required|string|max:50',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note mise à jour avec succès!');
    }

    /**
     * Supprimer une note
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note supprimée avec succès!');
    }

    /**
     * Consultation des propres notes de l'apprenant
     */
    public function myNotes()
    {
        if (!auth()->user()->hasRole('apprenant')) {
            abort(403, 'Seuls les apprenants peuvent consulter leurs notes.');
        }

        // Chercher l'apprenant associé à l'utilisateur (relation à créer dans le modèle User)
        $notes = Note::whereHas('apprenant', function($query) {
            $query->where('email', auth()->user()->email);
        })->with('matiere')->get();

        return view('notes.my-notes', compact('notes'));
    }
}
