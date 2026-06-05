<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Gestion Bulletin CPET'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        :root {
            --color-primary: #0052CC;
            --color-primary-light: #E6EEFF;
            --color-primary-dark: #003D99;
            --color-accent: #20C997;
            --color-accent-light: #E3FDF8;
            --color-gray-50: #FAFAFA;
            --color-gray-100: #F3F4F6;
            --color-gray-200: #E5E7EB;
            --color-gray-300: #D1D5DB;
            --color-gray-600: #4B5563;
            --color-gray-700: #374151;
            --color-gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: white;
            color: var(--color-gray-900);
        }

        /* Force mode clair partout */
        html {
            background-color: white !important;
        }

        /* Supprime tous les fonds gris/sombres */
        .bg-gray-50,
        .bg-gray-100,
        .bg-gray-200,
        .bg-gray-700,
        .bg-gray-800,
        .dark\:bg-gray-700,
        .dark\:bg-gray-800,
        [class*="dark:bg-gray-"],
        [class*="dark:bg-white"] {
            background-color: white !important;
        }

        /* Force le texte sombre */
        .dark\:text-white,
        .dark\:text-gray-100,
        .dark\:text-gray-300,
        .dark\:text-gray-400 {
            color: var(--color-gray-900) !important;
        }

        /* Tables */
        table {
            background-color: white !important;
        }

        thead {
            background-color: #F3F4F6 !important;
            color: var(--color-gray-900) !important;
        }

        tbody tr {
            background-color: white !important;
            border-bottom-color: #E5E7EB !important;
        }

        tbody tr:hover {
            background-color: #F9FAFB !important;
        }

        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: linear-gradient(135deg, var(--color-primary) 0%, #003D99 100%);
            color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 12px rgba(0, 82, 204, 0.15);
            transition: transform 0.3s ease, width 0.3s ease;
            overflow-y: auto;
            position: relative;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .sidebar-brand-text,
        .sidebar.collapsed .nav-link-text,
        .sidebar.collapsed .sidebar-footer-text {
            display: none;
        }

        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.collapsed .sidebar-brand {
            padding: 24px 12px;
            justify-content: center;
        }

        .sidebar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .sidebar-brand-text {
            font-weight: 600;
            font-size: 12px;
            line-height: 1.3;
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar.collapsed .nav-link {
            padding: 12px 8px;
            justify-content: center;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 24px;
        }

        .sidebar.collapsed .nav-link:hover {
            padding-left: 8px;
        }

        .nav-link.active {
            background-color: var(--color-accent);
            color: var(--color-primary);
            font-weight: 600;
            border-radius: 0 8px 8px 0;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: white;
        }

        .nav-link svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .nav-link-text {
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-toggle {
            width: 40px;
            height: 40px;
            background: transparent;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--color-primary);
            font-weight: bold;
            font-size: 20px;
            padding: 8px;
            margin: 0;
            z-index: 999;
        }

        .sidebar-toggle:hover {
            background-color: var(--color-primary-light);
            color: var(--color-primary-dark);
            transform: scale(1.05);
        }

        .sidebar.collapsed .sidebar-toggle {
            color: var(--color-primary);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        .sidebar.collapsed .sidebar-footer {
            padding: 16px 8px;
            text-align: center;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: white;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid var(--color-gray-200);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-button {
            display: flex;
            align-items: center;
            gap: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .profile-button:hover {
            background-color: var(--color-gray-100);
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-gray-900);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--color-gray-200);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            min-width: 180px;
            margin-top: 8px;
            display: none;
            z-index: 1001;
            overflow: hidden;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            font-size: 14px;
            color: var(--color-gray-700);
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: var(--color-gray-100);
        }

        .dropdown-item:last-child {
            color: #DC2626;
        }

        .content-area {
            flex: 1;
            overflow-y: auto;
            padding: 32px;
            background: white !important;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }

        .page-footer {
            border-top: 1px solid var(--color-gray-200);
            padding-top: 32px;
            margin-top: 32px;
            background: white;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .footer-brand img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
        }

        .footer-brand-text {
            font-weight: 600;
            font-size: 14px;
            color: var(--color-primary);
        }

        .footer-nav {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 32px;
            margin-bottom: 24px;
        }

        .footer-nav-section h3 {
            font-size: 13px;
            font-weight: 600;
            color: var(--color-gray-900);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-nav-section a,
        .footer-nav-section span {
            display: block;
            font-size: 13px;
            color: var(--color-gray-600);
            text-decoration: none;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .footer-nav-section a:hover {
            color: var(--color-primary);
        }

        .footer-bottom {
            border-top: 1px solid var(--color-gray-200);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--color-gray-600);
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-links {
            display: flex;
            gap: 16px;
        }

        .footer-links a {
            color: var(--color-gray-600);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-primary);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                height: 100%;
                top: 0;
                z-index: 999;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .app-container.sidebar-open::before {
                content: '';
                position: fixed;
                inset: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 998;
            }

            .topbar {
                padding: 0 16px;
            }

            .content-area {
                padding: 16px;
            }
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar,
        .sidebar-nav::-webkit-scrollbar,
        .content-area::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track,
        .sidebar-nav::-webkit-scrollbar-track,
        .content-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .content-area::-webkit-scrollbar-thumb {
            background: var(--color-gray-300);
            border-radius: 3px;
        }

        .content-area::-webkit-scrollbar-thumb:hover {
            background: var(--color-gray-400);
        }
    </style>
</head>
<body>
    
    <div class="app-container" id="appContainer">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <!-- Brand -->
            <div class="sidebar-brand">
                <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="Logo CPET" onerror="this.src='<?php echo e(asset('images/logo.png')); ?>'">
                <span class="sidebar-brand-text">Gestion Bulletin CPET</span>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="nav-link-text">Dashboard</span>
                </a>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->hasPermissionTo('gerer_utilisateurs')): ?>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 13a6 6 0 11-12 0 6 6 0 0112 0zm0 0a6 6 0 100 12 6 6 0 000-12z"></path>
                            </svg>
                            <span class="nav-link-text">Utilisateurs</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('gerer_apprenants')): ?>
                        <a href="<?php echo e(route('apprenants.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apprenants.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                            </svg>
                            <span class="nav-link-text">Apprenants</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('gerer_classes_filieres')): ?>
                        <a href="<?php echo e(route('classes.index')); ?>" class="nav-link <?php echo e(request()->routeIs('classes.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"></path>
                            </svg>
                            <span class="nav-link-text">Classes</span>
                        </a>
                        <a href="<?php echo e(route('filieres.index')); ?>" class="nav-link <?php echo e(request()->routeIs('filieres.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                            </svg>
                            <span class="nav-link-text">Filières</span>
                        </a>
                        <a href="<?php echo e(route('matieres.index')); ?>" class="nav-link <?php echo e(request()->routeIs('matieres.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.669 0-3.218-.51-4.5-1.385A7.968 7.968 0 009 4.804z"></path>
                            </svg>
                            <span class="nav-link-text">Matières</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('saisir_notes')): ?>
                        <a href="<?php echo e(route('notes.index')); ?>" class="nav-link <?php echo e(request()->routeIs('notes.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"></path>
                            </svg>
                            <span class="nav-link-text">Saisir Notes</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('consulter_propres_notes')): ?>
                        <a href="<?php echo e(route('my-notes.index')); ?>" class="nav-link <?php echo e(request()->routeIs('my-notes.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.488 5.953 1.488a1 1 0 001.169-1.409l-7-14z"></path>
                            </svg>
                            <span class="nav-link-text">Mes Notes</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('enregistrer_absences')): ?>
                        <a href="<?php echo e(route('absences.index')); ?>" class="nav-link <?php echo e(request()->routeIs('absences.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="nav-link-text">Absences</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('generer_bulletins_pdf')): ?>
                        <a href="<?php echo e(route('bulletins.index')); ?>" class="nav-link <?php echo e(request()->routeIs('bulletins.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 100-2H3a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 100 2 2 2 0 012 2v2H4V5z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="nav-link-text">Bulletins</span>
                        </a>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasPermissionTo('consulter_statistiques')): ?>
                        <a href="<?php echo e(route('statistics.index')); ?>" class="nav-link <?php echo e(request()->routeIs('statistics.*') ? 'active' : ''); ?>">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                            </svg>
                            <span class="nav-link-text">Statistiques</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>

            <!-- Footer -->
            <div class="sidebar-footer">
                <div class="sidebar-footer-text">© 2026 CPET</div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- TOPBAR -->
            <div class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" title="Afficher/Masquer le menu">☰</button>
                </div>
                <div class="topbar-profile">
                    <div class="profile-dropdown">
                        <button class="profile-button" id="profileButton">
                            <div class="profile-avatar"><?php echo e(substr(auth()->user()->name, 0, 1)); ?></div>
                            <span class="profile-name"><?php echo e(auth()->user()->name); ?></span>
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">Profil</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: contents;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            <?php if(session('success')): ?>
                <div class="content-wrapper mb-4">
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="content-wrapper mb-4">
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <?php echo e(session('error')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="content-wrapper mb-4">
                    <div class="mb-4 p-4 text-sm text-indigo-800 rounded-lg bg-indigo-50 dark:bg-gray-800 dark:text-indigo-300">
                        <?php echo e(session('status')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <!-- CONTENT -->
            <div class="content-area">
                <div class="content-wrapper">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>


                <!-- FOOTER -->
                <footer class="page-footer">
                    <div class="footer-content">
                        <!-- Logo et présentation -->
                        <div class="footer-brand">
                            <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="Logo CPET" onerror="this.src='<?php echo e(asset('images/logo.png')); ?>'">
                            <div>
                                <div class="footer-brand-text">Gestion Bulletin CPET</div>
                                <div style="font-size: 12px; color: var(--color-gray-600); margin-top: 2px;">Gestion complète des bulletins scolaires</div>
                            </div>
                        </div>

                        <!-- Navigation Footer -->
                        <div class="footer-nav">
                            <?php if(auth()->guard()->check()): ?>
                                <!-- Section Gestion -->
                                <?php if(auth()->user()->hasPermissionTo('gerer_apprenants') || auth()->user()->hasPermissionTo('gerer_classes_filieres')): ?>
                                    <div class="footer-nav-section">
                                        <h3>Gestion</h3>
                                        <?php if(auth()->user()->hasPermissionTo('gerer_apprenants')): ?>
                                            <a href="<?php echo e(route('apprenants.index')); ?>">Apprenants</a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermissionTo('gerer_classes_filieres')): ?>
                                            <a href="<?php echo e(route('classes.index')); ?>">Classes</a>
                                            <a href="<?php echo e(route('filieres.index')); ?>">Filières</a>
                                            <a href="<?php echo e(route('matieres.index')); ?>">Matières</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Section Notes -->
                                <?php if(auth()->user()->hasPermissionTo('saisir_notes') || auth()->user()->hasPermissionTo('consulter_propres_notes')): ?>
                                    <div class="footer-nav-section">
                                        <h3>Notes</h3>
                                        <?php if(auth()->user()->hasPermissionTo('saisir_notes')): ?>
                                            <a href="<?php echo e(route('notes.index')); ?>">Saisir Notes</a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermissionTo('consulter_propres_notes')): ?>
                                            <a href="<?php echo e(route('my-notes.index')); ?>">Mes Notes</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Section Autres -->
                                <?php if(auth()->user()->hasPermissionTo('enregistrer_absences') || auth()->user()->hasPermissionTo('generer_bulletins_pdf') || auth()->user()->hasPermissionTo('consulter_statistiques')): ?>
                                    <div class="footer-nav-section">
                                        <h3>Autres</h3>
                                        <?php if(auth()->user()->hasPermissionTo('enregistrer_absences')): ?>
                                            <a href="<?php echo e(route('absences.index')); ?>">Absences</a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermissionTo('generer_bulletins_pdf')): ?>
                                            <a href="<?php echo e(route('bulletins.index')); ?>">Bulletins</a>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasPermissionTo('consulter_statistiques')): ?>
                                            <a href="<?php echo e(route('statistics.index')); ?>">Statistiques</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Section Utilisateur -->
                                <div class="footer-nav-section">
                                    <h3>Compte</h3>
                                    <a href="<?php echo e(route('profile.edit')); ?>">Mon Profil</a>
                                    <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Footer Bottom -->
                        <div class="footer-bottom">
                            <div>© 2026 <strong>CPET</strong> - Gestion Bulletin. Tous droits réservés.</div>
                            <div class="footer-links">
                                <a href="#">Politique de confidentialité</a>
                                <a href="#">Conditions d'utilisation</a>
                                <a href="#">Support</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const appContainer = document.getElementById('appContainer');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
        }

        // Restore collapsed state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
        }

        // Profile dropdown
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (profileButton && dropdownMenu) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });
        }

        // Mobile sidebar
        const toggleMobileSidebar = () => {
            appContainer.classList.toggle('sidebar-open');
            sidebar.classList.toggle('active');
        };
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/layouts/app-sidebar.blade.php ENDPATH**/ ?>