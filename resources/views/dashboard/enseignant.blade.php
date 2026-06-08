@extends('layouts.app-sidebar')

@section('title', 'Tableau de Bord - Enseignant')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }}!</h1>
            <p class="text-green-100">Tableau de bord Enseignant</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Apprenants</p>
                            <p class="text-3xl font-bold">{{ $apprenants->count() }}</p>
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
                            <p class="text-3xl font-bold">{{ $classes->count() }}</p>
                        </div>
                        <i class="fas fa-chalkboard text-4xl text-green-500 opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Notes Récentes</p>
                            <p class="text-3xl font-bold">{{ $recentNotes->count() }}</p>
                        </div>
                        <i class="fas fa-chart-line text-4xl text-indigo-500 opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Gestion Notes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Gestion des Notes</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Saisissez ou modifiez les notes de vos apprenants.</p>
                    <div class="space-y-2">
                        <a href="{{ route('notes.index') }}" class="block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-center">
                            Voir toutes les notes
                        </a>
                        <a href="{{ route('notes.create') }}" class="block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-center">
                            <i class="fas fa-plus mr-2"></i>Ajouter une note
                        </a>
                    </div>
                </div>
            </div>

            <!-- Génération Bulletins -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Bulletins</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Générez et téléchargez les bulletins de vos apprenants.</p>
                    <div class="space-y-2">
                        <a href="{{ route('bulletins.index') }}" class="block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-center">
                            Voir les bulletins
                        </a>
                        <a href="{{ route('bulletins.create') }}" class="block px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 text-center">
                            <i class="fas fa-plus mr-2"></i>Générer un bulletin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Récentes -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-bold mb-4">10 Dernières Notes Saisies</h2>
                @if($recentNotes->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left">Apprenant</th>
                                    <th class="px-4 py-2 text-left">Matière</th>
                                    <th class="px-4 py-2 text-left">Type</th>
                                    <th class="px-4 py-2 text-right">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentNotes as $note)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $note->apprenant->nom }} {{ $note->apprenant->prenom }}</td>
                                        <td class="px-4 py-2">{{ $note->matiere->nom_matiere }}</td>
                                        <td class="px-4 py-2">{{ $note->type_evaluation }}</td>
                                        <td class="px-4 py-2 text-right font-bold">{{ $note->note }}/20</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Aucune note saisie pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
