<x-mail::message>
# 📋 Absence Enregistrée

Bonjour {{ $apprenant->nom_apprenant }},

Une absence a été enregistrée dans votre dossier scolaire.

**Détails de l'Absence:**
- **Apprenant:** {{ $apprenant->nom_apprenant }}
- **Classe:** {{ $classe->nom_classe }}
- **Date de l'Absence:** {{ $absence->date_absence->format('d/m/Y') }}
- **Justifiée:** {{ $absence->justifiee ? '✅ Oui' : '❌ Non' }}
@if($absence->motif)
- **Motif:** {{ $absence->motif }}
@endif
- **Date d'Enregistrement:** {{ $absence->created_at->format('d/m/Y à H:i') }}

@if(!$absence->justifiee)
**⚠️ Attention:** Cette absence n'a pas été justifiée. Si vous avez un document de justification, veuillez le remettre au secrétariat rapidement.
@endif

<x-mail::button :url="route('dashboard')">
Consulter Votre Dossier
</x-mail::button>

En cas de question, veuillez contacter le secrétariat ou votre directeur de classe.

Cordialement,<br>
L'équipe de Gestion Bulletin CPET
</x-mail::message>
