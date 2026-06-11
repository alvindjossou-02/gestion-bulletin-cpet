<?php

namespace App\Http\Controllers;

use App\Mail\BulletinGenerated;
use App\Models\Bulletin;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class BulletinController extends Controller
{
    /**
     * Afficher la liste des bulletins
     */
    public function index()
    {
        $bulletins = Bulletin::with('apprenant')->paginate(15);
        return view('bulletins.index', compact('bulletins'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $apprenants = Apprenant::all();
        $trimestres = ['1er Trimestre', '2e Trimestre', '3e Trimestre'];
        return view('bulletins.create', compact('apprenants', 'trimestres'));
    }

    /**
     * Stocker un bulletin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'moyenne_generale' => 'required|numeric|min:0|max:20',
            'rang' => 'required|integer|min:1',
            'appreciation' => 'nullable|string|max:500',
            'trimestre' => 'required|string|in:1er Trimestre,2e Trimestre,3e Trimestre',
        ]);

        $bulletin = Bulletin::create($validated);

        // Charger les relations pour l'email
        $bulletin = $bulletin->load('apprenant.classe.filiere');

        // Envoyer un email de notification à l'apprenant
        if ($bulletin->apprenant->user) {
            Mail::queue(new BulletinGenerated($bulletin));
        }

        return redirect()->route('bulletins.index')
            ->with('success', 'Bulletin créé avec succès! Un email de notification a été envoyé.');
    }
    }

    /**
     * Afficher les détails d'un bulletin
     */
    public function show(Bulletin $bulletin)
    {
        return view('bulletins.show', compact('bulletin'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Bulletin $bulletin)
    {
        $apprenants = Apprenant::all();
        $trimestres = ['1er Trimestre', '2e Trimestre', '3e Trimestre'];
        return view('bulletins.edit', compact('bulletin', 'apprenants', 'trimestres'));
    }

    /**
     * Mettre à jour un bulletin
     */
    public function update(Request $request, Bulletin $bulletin)
    {
        $validated = $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'moyenne_generale' => 'required|numeric|min:0|max:20',
            'rang' => 'required|integer|min:1',
            'appreciation' => 'nullable|string|max:500',
            'trimestre' => 'required|string|in:1er Trimestre,2e Trimestre,3e Trimestre',
        ]);

        $bulletin->update($validated);

        return redirect()->route('bulletins.index')
            ->with('success', 'Bulletin mis à jour avec succès!');
    }

    /**
     * Supprimer un bulletin
     */
    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();

        return redirect()->route('bulletins.index')
            ->with('success', 'Bulletin supprimé avec succès!');
    }

    /**
     * Télécharger le bulletin en PDF
     */
    public function downloadPDF(Bulletin $bulletin)
    {
        $data = [
            'bulletin' => $bulletin->load(['apprenant.filiere', 'apprenant.classe', 'apprenant.notes.matiere']),
        ];

        // Générer le PDF (nécessite barryvdh/laravel-dompdf)
        // return PDF::loadView('bulletins.pdf', $data)->download('bulletin_' . ($bulletin->apprenant?->matricule ?? 'bulletin') . '.pdf');

        // Pour maintenant, afficher la vue PDF
        return view('bulletins.pdf', $data);
    }
}
