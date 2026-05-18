@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Ajouter une Note</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="apprenant_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apprenant</label>
                        <select name="apprenant_id" id="apprenant_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner un apprenant --</option>
                            @foreach($apprenants as $apprenant)
                                <option value="{{ $apprenant->id }}" {{ old('apprenant_id') == $apprenant->id ? 'selected' : '' }}>
                                    {{ $apprenant->nom }} {{ $apprenant->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="matiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Matière</label>
                        <select name="matiere_id" id="matiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner une matière --</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                                    {{ $matiere->nom_matiere }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="type_evaluation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type d'Évaluation</label>
                        <select name="type_evaluation" id="type_evaluation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                            <option value="">-- Sélectionner un type --</option>
                            @foreach($typeEvaluations as $type)
                                <option value="{{ $type }}" {{ old('type_evaluation') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note (0-20)</label>
                        <input type="number" name="note" id="note" min="0" max="20" step="0.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required value="{{ old('note') }}">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('notes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
