@extends('layouts.app-sidebar')

@section('title', 'Tableau de Bord - Apprenant')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, {{ $apprenant->nom }} {{ $apprenant->prenom }}!</h1>
            <p class="text-blue-100">Classe: <strong>{{ $apprenant->classe->nom_classe }}</strong> | Filière: <strong>{{ $apprenant->filiere->nom_filiere }}</strong></p>
        </div>

        <!-- Notes Récentes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Vos Dernières Notes</h2>
                    @if($notes->count() > 0)
                        <div class="space-y-3">
                            @foreach($notes as $note)
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                    <div>
                                        <p class="font-medium">{{ $note->matiere->nom_matiere }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $note->type_evaluation }}</p>
                                    </div>
                                    <span class="text-2xl font-bold text-indigo-600">{{ $note->note }}/20</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Aucune note enregistrée pour le moment.</p>
                    @endif
                    <a href="{{ route('my-notes.index') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Voir toutes les notes
                    </a>
                </div>
            </div>

            <!-- Bulletin -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Votre Bulletin</h2>
                    @if($bulletin)
                        <div class="p-4 bg-green-50 dark:bg-green-900 rounded">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Bulletin de période</p>
                            <p class="font-medium mb-4">Moyenne générale: <strong>{{ number_format($bulletin->moyenne_generale, 2) }}</strong>/20</p>
                            <a href="{{ route('bulletins.pdf', $bulletin) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                <i class="fas fa-download mr-2"></i>Télécharger le PDF
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">Aucun bulletin disponible pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-bold mb-4">Liens Rapides</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('my-notes.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-list text-indigo-600 text-lg mb-2"></i>
                        <p class="font-medium">Mes Notes</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Consultez toutes vos notes</p>
                    </a>
                    <a href="{{ route('bulletins.index') }}" class="p-4 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-file-pdf text-red-600 text-lg mb-2"></i>
                        <p class="font-medium">Bulletins</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Téléchargez vos bulletins</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
