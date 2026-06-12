@extends('layouts.app-sidebar')

@section('title', 'Créer Bulletin - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Générer un Bulletin</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('bulletins.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="apprenant_id" class="block text-sm font-medium text-gray-700">Apprenant</label>
                        <select name="apprenant_id" id="apprenant_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900" required>
                            <option value="">-- Sélectionner un apprenant --</option>
                            @foreach($apprenants as $apprenant)
                                <option value="{{ $apprenant->id }}" {{ old('apprenant_id') == $apprenant->id ? 'selected' : '' }}>
                                    {{ $apprenant->nom }} {{ $apprenant->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="trimestre" class="block text-sm font-medium text-gray-700">Trimestre</label>
                        <select name="trimestre" id="trimestre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900" required>
                            @foreach($trimestres as $trimestre)
                                <option value="{{ $trimestre }}" {{ old('trimestre') == $trimestre ? 'selected' : '' }}>{{ $trimestre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="moyenne_generale" class="block text-sm font-medium text-gray-700">Moyenne Générale (0-20)</label>
                        <input type="number" name="moyenne_generale" id="moyenne_generale" min="0" max="20" step="0.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900" required value="{{ old('moyenne_generale') }}">
                    </div>

                    <div>
                        <label for="rang" class="block text-sm font-medium text-gray-700">Rang</label>
                        <input type="number" name="rang" id="rang" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900" required value="{{ old('rang') }}">
                    </div>

                    <div>
                        <label for="appreciation" class="block text-sm font-medium text-gray-700">Appréciation</label>
                        <textarea name="appreciation" id="appreciation" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900">{{ old('appreciation') }}</textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('bulletins.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
