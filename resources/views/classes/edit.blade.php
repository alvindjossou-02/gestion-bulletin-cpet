@extends('layouts.app-sidebar')

@section('title', 'Modifier Classe - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Modifier la classe</h1>

                @if($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('classes.update', $classe) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="nom_classe" class="block text-sm font-medium text-gray-700">Nom de classe</label>
                        <input id="nom_classe" name="nom_classe" type="text" value="{{ old('nom_classe', $classe->nom_classe) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900" required>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enregistrer</button>
                        <a href="{{ route('classes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
