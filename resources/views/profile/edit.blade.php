@extends('layouts.app-sidebar')

@section('title', 'Modifier Profil - Gestion Bulletin CPET')

@section('content')
    <div class="space-y-6">
        <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="max-width: 40rem;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="max-width: 40rem;">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="max-width: 40rem;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
