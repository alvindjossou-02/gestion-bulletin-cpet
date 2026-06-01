@extends('layouts.app-sidebar')

@section('title', 'Ajouter Apprenant - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Ajouter un apprenant</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('apprenants.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                        <input id="nom" name="nom" type="text" value="{{ old('nom') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                        <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="matricule" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Matricule</label>
                        <input id="matricule" name="matricule" type="text" value="{{ old('matricule') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="sexe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sexe</label>
                        <select id="sexe" name="sexe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>F</option>
                        </select>
                    </div>

                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de naissance</label>
                        <input id="date_naissance" name="date_naissance" type="date" value="{{ old('date_naissance') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="reboublant" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('reboublant') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">Reboublant</span>
                        </label>
                    </div>

                    <div>
                        <label for="filiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filière</label>
                        <select id="filiere_id" name="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une filière --</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom_filiere }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Classe</label>
                        <select id="classe_id" name="classe_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une classe --</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>{{ $classe->nom_classe }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('apprenants.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
