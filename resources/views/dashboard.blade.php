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
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('apprenants.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>👥 Apprenants</span>
                        </a>
                        <a href="{{ route('classes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>📚 Classes</span>
                        </a>
                        <a href="{{ route('filieres.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>🎓 Filières</span>
                        </a>
                        <a href="{{ route('matieres.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                            <span>📖 Matières</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Opérations</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('notes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                            <span>✏️ Notes</span>
                        </a>
                        <a href="{{ route('bulletins.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                            <span>📄 Bulletins</span>
                        </a>
                        <a href="{{ route('statistics.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                            <span>📊 Stats</span>
                        </a>
                        @if(auth()->user()->hasRole(['administrateur']))
                            <a href="{{ route('audit-logs.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition duration-150">
                                <span>🔍 Audit</span>
                            </a>
                        @endif
                    </div>
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <a href="{{ route('notes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>✏️ Saisir Notes</span>
                    </a>
                    <a href="{{ route('absences.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="{{ route('bulletins.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📄 Bulletins</span>
                    </a>
                    <a href="{{ route('statistics.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>📊 Stats</span>
                    </a>
                </div>
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
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('my-notes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>📝 Mes Notes</span>
                    </a>
                    <a href="{{ route('bulletins.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📄 Bulletins</span>
                    </a>
                </div>
            </div>

        {{-- Secrétaire Dashboard --}}
        @elseif(auth()->user()->hasRole('secretaire'))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
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
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Absences</p>
                        <p class="text-3xl font-bold text-orange-600">{{ \App\Models\Absence::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('apprenants.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="{{ route('absences.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="{{ route('classes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📚 Classes</span>
                    </a>
                    <a href="{{ route('statistics.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
            </div>

        {{-- Comptable Dashboard --}}
        @elseif(auth()->user()->hasRole('comptable'))
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('apprenants.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="{{ route('statistics.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
            </div>

        {{-- Surveillant Général Dashboard --}}
        @elseif(auth()->user()->hasRole('surveillant_general'))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Absences</p>
                        <p class="text-3xl font-bold text-red-600">{{ \App\Models\Absence::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Apprenants</p>
                        <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Apprenant::count() }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Classes</p>
                        <p class="text-3xl font-bold text-green-600">{{ \App\Models\Classe::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Mes Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('absences.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition duration-150">
                        <span>📋 Absences</span>
                    </a>
                    <a href="{{ route('apprenants.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-150">
                        <span>👥 Apprenants</span>
                    </a>
                    <a href="{{ route('classes.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-150">
                        <span>📚 Classes</span>
                    </a>
                    <a href="{{ route('statistics.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 transition duration-150">
                        <span>📊 Statistiques</span>
                    </a>
                </div>
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

