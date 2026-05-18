@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Mes Notes</h1>

                @if($notes->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Matière</th>
                                    <th scope="col" class="px-6 py-3">Type d'Évaluation</th>
                                    <th scope="col" class="px-6 py-3">Note</th>
                                    <th scope="col" class="px-6 py-3">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium">{{ $note->matiere?->nom_matiere ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $note->type_evaluation }}</td>
                                        <td class="px-6 py-4"><span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800">{{ $note->note }}/20</span></td>
                                        <td class="px-6 py-4">
                                            @if($note->note >= 12)
                                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800">✓ Réussi</span>
                                            @else
                                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-800">✗ Insuffisant</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    @if(isset($isLinked) && !$isLinked)
                        <p class="text-gray-500 text-center py-8">Votre compte n'est pas encore lié à une fiche apprenant. Contactez l'administration pour associer votre profil.</p>
                    @else
                        <p class="text-gray-500 text-center py-8">Aucune note disponible.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
