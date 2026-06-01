@extends('layouts.app-sidebar')

@section('title', 'Dashboard - Gestion Bulletin CPET')

@section('content')
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 28px; font-weight: 600; margin-bottom: 32px; color: #111827;">Bienvenue sur le Dashboard</h1>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
            <!-- Card Statistiques -->
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #0052CC;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Apprenants</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;">{{ \App\Models\Apprenant::count() }}</div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #20C997;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Classes</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;">{{ \App\Models\Classe::count() }}</div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #0052CC;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Matières</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;">{{ \App\Models\Matiere::count() }}</div>
            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid #20C997;">
                <div style="font-size: 14px; color: #4B5563; margin-bottom: 8px;">Notes</div>
                <div style="font-size: 32px; font-weight: 600; color: #111827;">{{ \App\Models\Note::count() }}</div>
            </div>
        </div>

        <div style="margin-top: 32px; background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <h2 style="font-size: 18px; font-weight: 600; margin-bottom: 16px; color: #111827;">Dernier Utilisateur Connecté</h2>
            <p style="color: #4B5563;">Bonjour <strong>{{ auth()->user()->name }}</strong>, bienvenue sur la gestion des bulletins du CPET.</p>
        </div>
    </div>
@endsection
