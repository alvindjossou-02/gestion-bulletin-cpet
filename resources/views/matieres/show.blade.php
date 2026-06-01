@extends('layouts.app-sidebar')

@section('title', 'Détails Matière - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Détails de la matière</h1>

                <div class="space-y-4">
                    <div><strong>Nom :</strong> {{ $matiere->nom_matiere }}</div>
                    <div><strong>Coefficient :</strong> {{ $matiere->coefficient }}</div>
                    <div><strong>Filière :</strong> {{ $matiere->filiere?->nom_filiere ?? 'N/A' }}</div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('matieres.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
