@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Détails de l'apprenant</h1>

                <div class="space-y-4">
                    <div><strong>Nom :</strong> {{ $apprenant->nom }}</div>
                    <div><strong>Prénom :</strong> {{ $apprenant->prenom }}</div>
                    <div><strong>Matricule :</strong> {{ $apprenant->matricule }}</div>
                    <div><strong>Sexe :</strong> {{ $apprenant->sexe }}</div>
                    <div><strong>Date de naissance :</strong> {{ $apprenant->date_naissance?->format('d/m/Y') }}</div>
                    <div><strong>Filière :</strong> {{ $apprenant->filiere?->nom_filiere ?? 'N/A' }}</div>
                    <div><strong>Classe :</strong> {{ $apprenant->classe?->nom_classe ?? 'N/A' }}</div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('apprenants.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
