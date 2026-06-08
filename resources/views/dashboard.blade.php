@extends('layouts.app-sidebar')

@section('title', 'Tableau de Bord - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Welcome Section --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }}!</h1>
            <p class="text-blue-100">Tableau de Bord - Gestion des Bulletins Scolaires</p>
        </div>

        {{-- Admin/Directeur Dashboard --}}
        @if(auth()->user()->hasRole(['administrateur', 'directeur', 'directrice']))
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Apprenant::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Classes</p>
                        <p class="text-3xl font-bold text-green-600">{{ \App\Models\Classe::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Filières</p>
                        <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Filiere::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes Saisies</p>
                        <p class="text-3xl font-bold text-orange-600">{{ \App\Models\Note::count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Gestion</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('apprenants.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Gérer Apprenants</a></li>
                        <li><a href="{{ route('classes.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Gérer Classes</a></li>
                        <li><a href="{{ route('filieres.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Gérer Filières</a></li>
                        <li><a href="{{ route('matieres.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Gérer Matières</a></li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Opérations</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('notes.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Saisir Notes</a></li>
                        <li><a href="{{ route('bulletins.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Génération Bulletins</a></li>
                        <li><a href="{{ route('statistics.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Statistiques</a></li>
                        @if(auth()->user()->hasRole(['administrateur']))
                            <li><a href="{{ route('audit.logs') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Journaux d'Audit</a></li>
                        @endif
                    </ul>
                </div>
            </div>

        {{-- Enseignant Dashboard --}}
        @elseif(auth()->user()->hasRole('enseignant'))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Apprenant::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes Saisies</p>
                        <p class="text-3xl font-bold text-green-600">{{ \App\Models\Note::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Absences</p>
                        <p class="text-3xl font-bold text-orange-600">{{ \App\Models\Absence::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('notes.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Saisir Notes</a></li>
                    <li><a href="{{ route('absences.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Enregistrer Absences</a></li>
                    <li><a href="{{ route('bulletins.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Consulter Bulletins</a></li>
                    <li><a href="{{ route('statistics.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Statistiques</a></li>
                </ul>
            </div>

        {{-- Apprenant Dashboard --}}
        @elseif(auth()->user()->hasRole('apprenant'))
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Informations</h2>
                @php
                    $apprenant = \App\Models\Apprenant::where('user_id', auth()->id())->first();
                @endphp
                @if($apprenant)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Nom:</strong> {{ $apprenant->nom }} {{ $apprenant->prenom }}</div>
                        <div><strong>Matricule:</strong> {{ $apprenant->matricule }}</div>
                        <div><strong>Classe:</strong> {{ $apprenant->classe?->nom ?? 'N/A' }}</div>
                        <div><strong>Filière:</strong> {{ $apprenant->filiere?->nom ?? 'N/A' }}</div>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Mes Notes</p>
                        @if($apprenant)
                            <p class="text-3xl font-bold text-blue-600">{{ $apprenant->notes()->count() }}</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Moyenne</p>
                        @if($apprenant && $apprenant->notes()->count() > 0)
                            @php
                                $moyenne = $apprenant->notes()->avg('note');
                            @endphp
                            <p class="text-3xl font-bold text-green-600">{{ number_format($moyenne, 2) }}/20</p>
                        @else
                            <p class="text-3xl font-bold text-gray-400">N/A</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('notes.my-notes') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Mes Notes</a></li>
                    <li><a href="{{ route('bulletins.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">→ Mes Bulletins</a></li>
                </ul>
            </div>

        {{-- Other Roles --}}
        @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Bienvenue</h2>
                <p class="text-gray-600 dark:text-gray-400">Vous êtes connecté en tant que <strong>{{ implode(', ', auth()->user()->roles->pluck('name')->toArray()) }}</strong></p>
                <p class="text-gray-600 dark:text-gray-400 mt-4">Accédez aux différentes sections via le menu de navigation.</p>
            </div>
        @endif

    </div>
</div>
@endsection

