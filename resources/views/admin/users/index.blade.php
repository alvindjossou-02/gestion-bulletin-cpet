@extends('layouts.app-sidebar')

@section('title', 'Gestion Utilisateurs - Gestion Bulletin CPET')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Gestion des Utilisateurs</h1>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Ajouter un utilisateur
                    </a>
                </div>

                @if($users->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-blue-50 to-blue-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nom</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Rôles</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                @forelse($user->roles as $role)
                                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-blue-100 text-blue-800">
                                                        <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $role->name)) }}</span>
                                                        <form method="POST" action="{{ route('admin.users.remove-role', ['user' => $user->id, 'role' => $role->name]) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir retirer ce rôle ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs px-2 py-0.5 bg-red-500 hover:bg-red-600 text-white rounded transition">Retirer</button>
                                                        </form>
                                                    </div>
                                                @empty
                                                    <span class="text-gray-500 italic">Aucun rôle assigné</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('admin.users.assign-role', $user->id) }}" class="inline-flex gap-2 items-center">
                                                @csrf
                                                <select name="role" class="text-xs rounded border-gray-300 bg-white text-gray-900" required>
                                                    <option value="">Assigner rôle</option>
                                                    @foreach($roles as $role)
                                                        @if(!$user->hasRole($role->name))
                                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="text-xs px-2 py-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded hover:from-blue-700 hover:to-blue-800 transition">Assigner</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Aucun utilisateur trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* CPET Color Scheme */
    :root {
        --cpet-primary: #0052CC;
        --cpet-dark: #003D99;
    }

    /* Custom gradient for buttons and headers */
    .bg-gradient-to-r.from-blue-600.to-blue-700 {
        background: linear-gradient(135deg, var(--cpet-primary) 0%, var(--cpet-dark) 100%);
    }

    .hover\:from-blue-700.hover\:to-blue-800:hover {
        background: linear-gradient(135deg, var(--cpet-dark) 0%, #002366 100%);
    }

    /* Table header styling */
    .bg-gradient-to-r.from-blue-50.to-blue-100 {
        background: linear-gradient(90deg, rgba(0, 82, 204, 0.05) 0%, rgba(0, 61, 153, 0.05) 100%);
    }

    /* Improve table row hover */
    tbody tr:hover {
        background-color: rgba(0, 82, 204, 0.02);
    }

    /* Button focus styles */
    button:focus {
        box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
    }
</style>
@endsection
