@extends('layouts.app-sidebar')

@section('title', 'Rapport Classe - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Rapport Classe: {{ $classe->nom_classe }}</h1>

                <div class="mb-6 p-4 bg-blue-50 dark:bg-gray-700 rounded">
                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Total Apprenants:</span> {{ $stats['total'] }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Moyenne Générale:</span> {{ round($stats['moyenne_generale'], 2) }}/20</p>
                </div>

                @if($stats['apprenants']->count())
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">Apprenant</th>
                                <th class="px-4 py-2 text-left">Moyenne</th>
                                <th class="px-4 py-2 text-left">Rang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['apprenants'] as $apprenant)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $apprenant['nom_complet'] }}</td>
                                    <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800">{{ $apprenant['moyenne'] }}/20</span></td>
                                    <td class="px-4 py-2">{{ $apprenant['rang'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Aucun apprenant dans cette classe.</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('statistics.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
