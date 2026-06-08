@extends('layouts.app-sidebar')

@section('title', 'Modifier Matière - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Modifier la matière</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('matieres.update', $matiere) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="nom_matiere" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la matière</label>
                        <input id="nom_matiere" name="nom_matiere" type="text" value="{{ old('nom_matiere', $matiere->nom_matiere) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="coefficient" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coefficient</label>
                        <input id="coefficient" name="coefficient" type="number" min="1" max="10" value="{{ old('coefficient', $matiere->coefficient) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label for="filiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filière</label>
                        <select id="filiere_id" name="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une filière --</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_id', $matiere->filiere_id) == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom_filiere }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Classe (optionnel)</label>
                        <select id="classe_id" name="classe_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                            <option value="">-- Aucune classe spécifique --</option>
                            @if(isset($classes))
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('classe_id', $matiere->classe_id) == $classe->id ? 'selected' : '' }}>{{ $classe->nom_classe }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('matieres.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
