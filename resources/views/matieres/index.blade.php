@extends('layouts.app-sidebar')

@section('title', 'Matières - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Matières</h1>
                    <a href="{{ route('matieres.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Ajouter une matière</a>
                </div>


                @if($matieres->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Matière</th>
                                    <th class="px-6 py-3">Coefficient</th>
                                    <th class="px-6 py-3">Filière</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($matieres as $matiere)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $matiere->nom_matiere }}</td>
                                        <td class="px-6 py-4">{{ $matiere->coefficient }}</td>
                                        <td class="px-6 py-4">{{ $matiere->filiere?->nom_filiere ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('matieres.edit', $matiere) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">
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
                        {{ $matieres->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Aucune matière enregistrée.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
