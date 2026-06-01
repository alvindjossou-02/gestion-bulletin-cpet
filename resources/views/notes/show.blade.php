@extends('layouts.app-sidebar')

@section('title', 'Détails Note - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Notes de {{ $apprenant->nom }} {{ $apprenant->prenom }}</h1>

                @if($notes->count())
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">Matière</th>
                                <th class="px-4 py-2 text-left">Type d'Évaluation</th>
                                <th class="px-4 py-2 text-left">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $note->matiere?->nom_matiere ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $note->type_evaluation }}</td>
                                    <td class="px-4 py-2"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800">{{ $note->note }}/20</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Aucune note pour cet apprenant.</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('notes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
