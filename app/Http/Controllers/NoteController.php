<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Apprenant;
use App\Models\Matiere;
use App\Models\Filiere;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
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
        $filieres = Filiere::all();
        
        // Charger les apprenants avec les classes pour les filtres en cascade
        $apprenants = Apprenant::with('classe')->get();
        
        return view('notes.create', compact('apprenants', 'matieres', 'filieres'));
    }

    /**
     * Stocker une note
     */
    public function store(StoreNoteRequest $request)
    {
        $validated = $request->validated();

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
        return view('notes.edit', compact('note', 'apprenants', 'matieres'));
    }

    /**
     * Mettre à jour une note
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $validated = $request->validated();

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
        $user = auth()->user();

        if (!$user->hasRole('apprenant')) {
            abort(403, 'Seuls les apprenants peuvent consulter leurs notes.');
        }

        // Récupérer l'apprenant lié à l'utilisateur par user_id
        $apprenant = Apprenant::where('user_id', $user->id)->first();

        if (!$apprenant) {
            return view('notes.my-notes', ['notes' => collect(), 'apprenant' => null]);
        }

        $notes = Note::where('apprenant_id', $apprenant->id)
            ->with('matiere')
            ->get()
            ->groupBy('type_evaluation');

        return view('notes.my-notes', compact('notes', 'apprenant'));
    }
}
