@extends('layouts.app-sidebar')

@section('title', 'Statistiques - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Tableau de Bord - Statistiques</h1>

        <!-- Statistiques principales -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Apprenants</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_apprenants'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Classes</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_classes'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Filières</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_filieres'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Notes</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_notes'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-600 dark:text-gray-400">Total Bulletins</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_bulletins'] }}</p>
            </div>
        </div>

        <!-- Meilleurs apprenants -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Top 10 Apprenants</h2>
            @if($topApprenants->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Apprenant</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topApprenants as $idx => $bulletin)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">#{{ $idx + 1 }} - {{ $bulletin->apprenant?->nom }} {{ $bulletin->apprenant?->prenom }}</td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-green-100 text-green-800">{{ $bulletin->moyenne_generale }}/20</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Aucune donnée disponible.</p>
            @endif
        </div>

        <!-- Distribution des notes -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Distribution des Notes</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="p-4 bg-green-100 rounded">
                    <p class="text-green-800 font-semibold">Excellent (18-20)</p>
                    <p class="text-2xl font-bold text-green-600">{{ $notesDistribution['excellent'] }}</p>
                </div>
                <div class="p-4 bg-blue-100 rounded">
                    <p class="text-blue-800 font-semibold">Très Bon (16-17)</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $notesDistribution['tres_bon'] }}</p>
                </div>
                <div class="p-4 bg-indigo-100 rounded">
                    <p class="text-indigo-800 font-semibold">Bon (14-15)</p>
                    <p class="text-2xl font-bold text-indigo-600">{{ $notesDistribution['bon'] }}</p>
                </div>
                <div class="p-4 bg-yellow-100 rounded">
                    <p class="text-yellow-800 font-semibold">Acceptable (12-13)</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $notesDistribution['acceptable'] }}</p>
                </div>
                <div class="p-4 bg-orange-100 rounded">
                    <p class="text-orange-800 font-semibold">Passable (10-11)</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $notesDistribution['passable'] }}</p>
                </div>
                <div class="p-4 bg-red-100 rounded">
                    <p class="text-red-800 font-semibold">Faible (&lt;10)</p>
                    <p class="text-2xl font-bold text-red-600">{{ $notesDistribution['faible'] }}</p>
                </div>
            </div>
        </div>

        <!-- Statistiques par classe -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Statistiques par Classe</h2>
            @if($classesStats->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Classe</th>
                            <th class="px-4 py-2 text-left">Apprenants</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classesStats as $classe)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 font-semibold">{{ $classe['nom'] }}</td>
                                <td class="px-4 py-2">{{ $classe['total_apprenants'] }}</td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800">{{ round($classe['moyenne_generale'], 2) }}/20</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Aucune donnée disponible.</p>
            @endif
        </div>

        <!-- Statistiques par filière -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Statistiques par Filière</h2>
            @if($filieresStats->count())
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Filière</th>
                            <th class="px-4 py-2 text-left">Apprenants</th>
                            <th class="px-4 py-2 text-left">Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filieresStats as $filiere)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 font-semibold">{{ $filiere['nom'] }}</td>
                                <td class="px-4 py-2">{{ $filiere['total_apprenants'] }}</td>
                                <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800">{{ round($filiere['moyenne_generale'], 2) }}/20</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Aucune donnée disponible.</p>
            @endif
        </div>
    </div>
</div>
@endsection
