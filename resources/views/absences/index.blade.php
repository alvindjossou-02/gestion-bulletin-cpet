@extends('layouts.app-sidebar')

@section('title', 'Absences - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Absences</h1>
                    <a href="{{ route('absences.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer une absence</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if($absences->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Apprenant</th>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Justifiée</th>
                                    <th class="px-6 py-3">Motif</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absences as $absence)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $absence->apprenant?->nom }} {{ $absence->apprenant?->prenom }}</td>
                                        <td class="px-6 py-4">{{ $absence->date_absence->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">
                                            @if($absence->justifiee)
                                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800">Oui</span>
                                            @else
                                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-800">Non</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $absence->motif }}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('absences.edit', $absence) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('absences.destroy', $absence) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?');">
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
                        {{ $absences->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Aucune absence enregistrée.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
