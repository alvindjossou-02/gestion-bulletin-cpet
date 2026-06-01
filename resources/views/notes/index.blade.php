@extends('layouts.app-sidebar')

@section('title', 'Saisir Notes - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Saisir les Notes</h1>
                    <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150">
                        + Ajouter une Note
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if($notes->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Apprenant</th>
                                    <th scope="col" class="px-6 py-3">Matière</th>
                                    <th scope="col" class="px-6 py-3">Type d'Évaluation</th>
                                    <th scope="col" class="px-6 py-3">Note</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 font-medium">{{ $note->apprenant?->nom ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $note->matiere?->nom_matiere ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $note->type_evaluation }}</td>
                                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800">{{ $note->note }}/20</span></td>
                                        <td class="px-6 py-4 flex gap-2">
                                            <a href="{{ route('notes.edit', $note) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr ?');">
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
                        {{ $notes->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Aucune note enregistrée.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
