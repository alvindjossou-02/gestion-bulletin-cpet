<!-- Sidebar Navigation Component -->
<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" 
           class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-700 dark:from-blue-950 dark:via-blue-900 dark:to-blue-800 text-white transition-all duration-300 ease-in-out shadow-lg overflow-hidden">
        
        <!-- Logo Section -->
        <div class="h-20 flex items-center justify-between px-4 border-b border-blue-700 dark:border-blue-800">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 min-w-0" :class="sidebarOpen ? '' : 'justify-center w-full'">
                <img src="{{ asset('images/logo.jpeg') }}" alt="CPET Logo" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" onerror="this.src='{{ asset('images/logo.png') }}'">
                <span v-show="sidebarOpen" class="text-sm font-bold whitespace-nowrap text-white">
                    Gestion<br>Bulletin
                </span>
            </a>
            
            <!-- Collapse Button -->
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="p-1.5 hover:bg-blue-700 dark:hover:bg-blue-700 rounded-lg transition-colors"
                    :class="sidebarOpen ? 'ml-2' : ''"
                    v-show="true">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          :d="sidebarOpen ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7'"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Items -->
        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-2">
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
               :class="sidebarOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V3"></path>
                </svg>
                <span v-show="sidebarOpen" class="font-medium text-sm">Tableau de Bord</span>
            </a>

            <!-- Section Administrateur & Directrice -->
            @if(auth()->user()->hasRole(['administrateur', 'directeur', 'directrice']))
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Utilisateurs') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Utilisateurs') }}</span>
                </a>
            @endif

            <!-- Gestion Apprenants -->
            @if(auth()->user()->hasPermissionTo('gerer_apprenants'))
                <a href="{{ route('apprenants.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('apprenants.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Apprenants') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a3 3 0 003-3v-2a3 3 0 00-3-3H3a3 3 0 00-3 3v2a3 3 0 003 3z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Apprenants') }}</span>
                </a>
            @endif

            <!-- Gestion Classes / Filières / Matières -->
            @if(auth()->user()->hasPermissionTo('gerer_classes_filieres'))
                <a href="{{ route('classes.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('classes.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Classes') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Classes') }}</span>
                </a>
                <a href="{{ route('filieres.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('filieres.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Filières') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Filières') }}</span>
                </a>
                <a href="{{ route('matieres.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('matieres.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Matières') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Matières') }}</span>
                </a>
            @endif

            <!-- Saisir Notes -->
            @if(auth()->user()->hasPermissionTo('saisir_notes'))
                <a href="{{ route('notes.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('notes.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Saisir Notes') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Saisir Notes') }}</span>
                </a>
            @endif

            <!-- Mes Notes (Apprenants) -->
            @if(auth()->user()->hasPermissionTo('consulter_propres_notes'))
                <a href="{{ route('my-notes.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('my-notes.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Mes Notes') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Mes Notes') }}</span>
                </a>
            @endif

            <!-- Absences -->
            @if(auth()->user()->hasPermissionTo('enregistrer_absences'))
                <a href="{{ route('absences.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('absences.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Absences') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Absences') }}</span>
                </a>
            @endif

            <!-- Bulletins -->
            @if(auth()->user()->hasPermissionTo('generer_bulletins_pdf'))
                <a href="{{ route('bulletins.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('bulletins.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Bulletins') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Bulletins') }}</span>
                </a>
            @endif

            <!-- Statistiques -->
            @if(auth()->user()->hasPermissionTo('consulter_statistiques'))
                <a href="{{ route('statistics.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('statistics.*') ? 'bg-green-500 dark:bg-green-600 text-white' : 'text-blue-100 hover:bg-blue-700 dark:hover:bg-blue-700' }}"
                   :class="sidebarOpen ? '' : 'justify-center'"
                   :title="!sidebarOpen ? '{{ __('Statistiques') }}' : ''">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span v-show="sidebarOpen" class="font-medium text-sm">{{ __('Statistiques') }}</span>
                </a>
            @endif
        </nav>

        <!-- User Section (Bottom) -->
        <div class="border-t border-blue-700 dark:border-blue-800 p-3">
            <div class="flex items-center justify-center gap-3" :class="sidebarOpen ? '' : 'flex-col'">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=22C55E&color=fff" 
                     alt="{{ Auth::user()->name }}" 
                     class="w-10 h-10 rounded-full flex-shrink-0">
                <div v-show="sidebarOpen" class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-blue-100 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar with User Dropdown -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center justify-between px-6 shadow-sm">
            <div></div>
            
            <!-- Settings Dropdown (Right Side) -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 z-50"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    <div class="py-1">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900">
            <!-- Page Header (si fourni) -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-full px-6 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <div class="p-6">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </div>
        </main>
    </div>
</div>
