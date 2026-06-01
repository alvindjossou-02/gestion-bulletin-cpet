@extends('layouts.app-sidebar')

@section('title', 'Filières - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Filières</h1>
                    <a href="{{ route('filieres.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Ajouter une filière</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if($filieres->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Filière</th>
                                    <th class="px-6 py-3">Apprenants</th>
                                    <th class="px-6 py-3">Matières</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filieres as $filiere)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $filiere->nom_filiere }}</td>
                                        <td class="px-6 py-4">{{ $filiere->apprenants?->count() ?? 0 }}</td>
                                        <td class="px-6 py-4">{{ $filiere->matieres?->count() ?? 0 }}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('filieres.edit', $filiere) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('filieres.destroy', $filiere) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?');">
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
                        {{ $filieres->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Aucune filière créée.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
