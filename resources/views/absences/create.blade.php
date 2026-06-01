@extends('layouts.app-sidebar')

@section('title', 'Enregistrer Absence - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Enregistrer une absence</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('absences.store') }}" class="space-y-6">
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
                        <label for="date_absence" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date d'absence</label>
                        <input type="date" name="date_absence" id="date_absence" value="{{ old('date_absence') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="justifiee" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('justifiee') ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">Justifiée</span>
                        </label>
                    </div>

                    <div>
                        <label for="motif" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motif (optionnel)</label>
                        <input type="text" name="motif" id="motif" value="{{ old('motif') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('absences.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
