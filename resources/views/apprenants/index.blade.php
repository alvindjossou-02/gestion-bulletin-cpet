@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Apprenants</h1>
                    <a href="{{ route('apprenants.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Ajouter un apprenant</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if($apprenants->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Nom</th>
                                    <th class="px-6 py-3">Prénom</th>
                                    <th class="px-6 py-3">Matricule</th>
                                    <th class="px-6 py-3">Sexe</th>
                                    <th class="px-6 py-3">Filière</th>
                                    <th class="px-6 py-3">Classe</th>
                                    <th class="px-6 py-3">Reboublant</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($apprenants as $apprenant)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $apprenant->nom }}</td>
                                        <td class="px-6 py-4">{{ $apprenant->prenom }}</td>
                                        <td class="px-6 py-4">{{ $apprenant->matricule }}</td>
                                        <td class="px-6 py-4">{{ $apprenant->sexe }}</td>
                                        <td class="px-6 py-4">{{ $apprenant->filiere?->nom_filiere ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $apprenant->classe?->nom_classe ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            @if($apprenant->reboublant)
                                                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Oui</span>
                                            @else
                                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800">Non</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('apprenants.edit', $apprenant) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('apprenants.destroy', $apprenant) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet apprenant ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $apprenants->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Aucun apprenant trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
