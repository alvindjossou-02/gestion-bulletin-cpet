@extends('layouts.app-sidebar')

@section('title', 'Tableau de Bord')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue {{ auth()->user()->name }}!</h1>
            <p class="text-blue-100">Rôle: <strong>{{ auth()->user()->getRoleNames()->first() }}</strong></p>
        </div>

        <!-- Basic Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Apprenants</p>
                            <p class="text-3xl font-bold">{{ $totalApprenants }}</p>
                        </div>
                        <i class="fas fa-users text-4xl text-blue-500 opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Classes</p>
                            <p class="text-3xl font-bold">{{ $totalClasses }}</p>
                        </div>
                        <i class="fas fa-chalkboard text-4xl text-green-500 opacity-20"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Message -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-bold mb-4">Bienvenue dans Gestion Bulletin CPET</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Vous êtes connecté en tant que <strong>{{ auth()->user()->getRoleNames()->first() }}</strong>.
                Utilisez le menu latéral pour naviguer vers les sections disponibles selon votre rôle.
            </p>
            <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900 rounded">
                <p class="text-sm text-blue-700 dark:text-blue-200">
                    <i class="fas fa-info-circle mr-2"></i>
                    Pour plus d'informations sur vos permissions, veuillez contacter un administrateur.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
