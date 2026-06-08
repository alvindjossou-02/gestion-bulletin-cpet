@extends('layouts.app-sidebar')

@section('title', 'Tableau de Bord - Administration')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Tableau de Bord d'Administration</h1>
            <p class="text-purple-100">Bienvenue {{ auth()->user()->name }}!</p>
        </div>

        <!-- Key Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Apprenants</p>
                            <p class="text-3xl font-bold">{{ $totalApprenants }}</p>
                        </div>
                        <i class="fas fa-users text-4xl text-blue-500 opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Classes</p>
                            <p class="text-3xl font-bold">{{ $totalClasses }}</p>
                        </div>
                        <i class="fas fa-chalkboard text-4xl text-green-500 opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Filières</p>
                            <p class="text-3xl font-bold">{{ $totalFilieres }}</p>
                        </div>
                        <i class="fas fa-book text-4xl text-orange-500 opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Dernières Notes</p>
                            <p class="text-3xl font-bold">{{ $recentNotes->count() }}</p>
                        </div>
                        <i class="fas fa-chart-line text-4xl text-indigo-500 opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Gestion des Données -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Gestion des Données</h2>
                    <div class="space-y-2">
                        <a href="{{ route('filieres.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-book text-blue-500 mr-3"></i>
                            <span>Filières</span>
                        </a>
                        <a href="{{ route('classes.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-chalkboard text-green-500 mr-3"></i>
                            <span>Classes</span>
                        </a>
                        <a href="{{ route('matieres.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-book-open text-purple-500 mr-3"></i>
                            <span>Matières</span>
                        </a>
                        <a href="{{ route('apprenants.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-users text-orange-500 mr-3"></i>
                            <span>Apprenants</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Gestion Administrative -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Gestion Administrative</h2>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-user-shield text-blue-500 mr-3"></i>
                            <span>Utilisateurs & Rôles</span>
                        </a>
                        <a href="{{ route('notes.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-list text-indigo-500 mr-3"></i>
                            <span>Notes</span>
                        </a>
                        <a href="{{ route('statistics.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-chart-bar text-red-500 mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                        <a href="{{ route('audit-logs.index') }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                            <i class="fas fa-history text-yellow-500 mr-3"></i>
                            <span>Journaux d'Audit</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Apprenants -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">5 Derniers Apprenants Ajoutés</h2>
                    @if($recentApprenants->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentApprenants as $apprenant)
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                    <div>
                                        <p class="font-medium">{{ $apprenant->nom }} {{ $apprenant->prenom }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $apprenant->classe->nom_classe }}</p>
                                    </div>
                                    <span class="text-xs px-3 py-1 bg-blue-100 text-blue-800 rounded">{{ $apprenant->matricule }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Aucun apprenant enregistré.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Notes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">10 Dernières Notes Saisies</h2>
                    @if($recentNotes->count() > 0)
                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            @foreach($recentNotes as $note)
                                <div class="flex justify-between items-center p-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-700 rounded">
                                    <div>
                                        <p class="font-medium">{{ $note->apprenant->nom }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $note->matiere->nom_matiere }}</p>
                                    </div>
                                    <span class="font-bold text-indigo-600">{{ $note->note }}/20</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Aucune note saisie.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
