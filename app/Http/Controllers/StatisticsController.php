<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use App\Models\Note;
use App\Models\Bulletin;
use App\Models\Classe;
use App\Models\Filiere;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Afficher le tableau de bord des statistiques
     */
    public function index()
    {
        $stats = [
            'total_apprenants' => Apprenant::count(),
            'total_classes' => Classe::count(),
            'total_filieres' => Filiere::count(),
            'total_notes' => Note::count(),
            'total_bulletins' => Bulletin::count(),
        ];

        $topApprenants = $this->getTopApprenants();
        $classesStats = $this->getClassesStats();
        $filieresStats = $this->getFilieresStats();
        $notesDistribution = $this->getNotesDistribution();

        return view('statistics.index', compact(
            'stats',
            'topApprenants',
            'classesStats',
            'filieresStats',
            'notesDistribution'
        ));
    }

    /**
     * Obtenir les meilleurs apprenants
     */
    private function getTopApprenants($limit = 10)
    {
        return Bulletin::query()
            ->with('apprenant:id,nom,prenom')
            ->orderByDesc('moyenne_generale')
            ->limit($limit)
            ->get(['id', 'apprenant_id', 'moyenne_generale']);
    }

    /**
     * Obtenir les statistiques par classe
     */
    private function getClassesStats()
    {
        // Agrégation côté base pour éviter les chargements N+1 et les calculs PHP coûteux
        // Hypothèse: bulletins.moyenne_generale contient une moyenne sur 20.
        return Classe::query()
            ->select('classes.id', 'classes.nom_classe')
            ->withCount('apprenants')
            ->leftJoin('apprenants', 'apprenants.classe_id', '=', 'classes.id')
            ->leftJoin('bulletins', 'bulletins.apprenant_id', '=', 'apprenants.id')
            ->groupBy('classes.id', 'classes.nom_classe')
            ->selectRaw('COUNT(DISTINCT apprenants.id) as total_apprenants_calc')
            ->selectRaw('COALESCE(AVG(bulletins.moyenne_generale), 0) as moyenne_generale')
            ->get()
            ->map(fn ($classe) => [
                'nom' => $classe->nom_classe,
                'total_apprenants' => (int) $classe->total_apprenants_calc,
                'moyenne_generale' => (float) $classe->moyenne_generale,
            ]);
    }

    /**
     * Obtenir les statistiques par filière
     */
    private function getFilieresStats()
    {
        // Agrégation côté base pour éviter les chargements N+1 et les calculs PHP coûteux
        return Filiere::query()
            ->select('filieres.id', 'filieres.nom_filiere')
            ->withCount('apprenants')
            ->leftJoin('apprenants', 'apprenants.filiere_id', '=', 'filieres.id')
            ->leftJoin('bulletins', 'bulletins.apprenant_id', '=', 'apprenants.id')
            ->groupBy('filieres.id', 'filieres.nom_filiere')
            ->selectRaw('COUNT(DISTINCT apprenants.id) as total_apprenants_calc')
            ->selectRaw('COALESCE(AVG(bulletins.moyenne_generale), 0) as moyenne_generale')
            ->get()
            ->map(fn ($filiere) => [
                'nom' => $filiere->nom_filiere,
                'total_apprenants' => (int) $filiere->total_apprenants_calc,
                'moyenne_generale' => (float) $filiere->moyenne_generale,
            ]);
    }

    /**
     * Distribution des notes
     */
    private function getNotesDistribution()
    {
        $notes = Note::pluck('note');

        return [
            'excellent' => $notes->filter(fn($n) => $n >= 18)->count(),     // 18-20
            'tres_bon' => $notes->filter(fn($n) => $n >= 16 && $n < 18)->count(), // 16-17
            'bon' => $notes->filter(fn($n) => $n >= 14 && $n < 16)->count(),      // 14-15
            'acceptable' => $notes->filter(fn($n) => $n >= 12 && $n < 14)->count(),// 12-13
            'passable' => $notes->filter(fn($n) => $n >= 10 && $n < 12)->count(),  // 10-11
            'faible' => $notes->filter(fn($n) => $n < 10)->count(),               // <10
        ];
    }

    /**
     * Rapport détaillé par classe
     */
    public function classReport(Classe $classe)
    {
        $apprenants = $classe->apprenants()->with('bulletins.apprenant')->get();

        $stats = [
            'total' => $apprenants->count(),
            'moyenne_generale' => $apprenants
                ->flatMap(fn($a) => $a->bulletins)
                ->pluck('moyenne_generale')
                ->avg(),
            'apprenants' => $apprenants->map(function($apprenant) {
                return [
                    'nom_complet' => $apprenant->nom . ' ' . $apprenant->prenom,
                    'moyenne' => $apprenant->bulletins->avg('moyenne_generale') ?? 0,
                    'rang' => $apprenant->bulletins->first()?->rang ?? 'N/A',
                ];
            })->sortByDesc('moyenne'),
        ];

        return view('statistics.class-report', compact('classe', 'stats'));
    }

    /**
     * Rapport détaillé par filière
     */
    public function filiereReport(Filiere $filiere)
    {
        $apprenants = $filiere->apprenants()->with('bulletins')->get();

        $stats = [
            'total' => $apprenants->count(),
            'moyenne_generale' => $apprenants
                ->flatMap(fn($a) => $a->bulletins)
                ->pluck('moyenne_generale')
                ->avg(),
            'apprenants' => $apprenants->map(function($apprenant) {
                return [
                    'nom_complet' => $apprenant->nom . ' ' . $apprenant->prenom,
                    'classe' => $apprenant->classe->nom_classe,
                    'moyenne' => $apprenant->bulletins->avg('moyenne_generale') ?? 0,
                ];
            })->sortByDesc('moyenne'),
        ];

        return view('statistics.filiere-report', compact('filiere', 'stats'));
    }
}
