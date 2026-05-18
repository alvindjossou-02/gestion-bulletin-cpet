@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Détails du Bulletin</h1>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Apprenant</p>
                        <p class="text-lg">{{ $bulletin->apprenant?->nom }} {{ $bulletin->apprenant?->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Trimestre</p>
                        <p class="text-lg">{{ $bulletin->trimestre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Moyenne Générale</p>
                        <p class="text-lg"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800">{{ $bulletin->moyenne_generale }}/20</span></p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Rang</p>
                        <p class="text-lg">{{ $bulletin->rang }}e</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-sm font-semibold text-gray-700">Appréciation</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $bulletin->appreciation ?? 'N/A' }}</p>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('bulletins.edit', $bulletin) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Modifier</a>
                    <a href="{{ route('bulletins.pdf', $bulletin) }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Télécharger PDF</a>
                    <a href="{{ route('bulletins.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
