<x-mail::message>
# 👋 Bienvenue sur Gestion Bulletin CPET

Bonjour {{ $user->name }},

Votre compte utilisateur a été créé avec succès par l'administration. Vous pouvez maintenant accéder à la plateforme.

**Vos Identifiants de Connexion:**
- **Email:** {{ $user->email }}
@if($temporaryPassword)
- **Mot de Passe Temporaire:** `{{ $temporaryPassword }}`
  **⚠️ Important:** Veuillez modifier votre mot de passe lors de votre première connexion
@endif

**Votre Rôle/Vos Rôles:**
@foreach($roles as $role)
- {{ ucfirst(str_replace('_', ' ', $role)) }}
@endforeach

<x-mail::button url="http://127.0.0.1:8000/login">
Se Connecter
</x-mail::button>

**Conseils de Sécurité:**
1. ✅ Gardez vos identifiants confidentiels
2. ✅ Changez votre mot de passe régulièrement
3. ✅ Ne partagez jamais votre compte avec d'autres personnes
4. ✅ Signalez tout accès non autorisé immédiatement

Si vous rencontrez des problèmes de connexion, veuillez contacter l'administrateur du système.

Cordialement,<br>
L'équipe de Gestion Bulletin CPET
</x-mail::message>
