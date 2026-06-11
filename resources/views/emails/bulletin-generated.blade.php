<x-mail::message>
# 📄 Votre Bulletin Scolaire est Prêt

Bonjour {{ $apprenant->nom_apprenant }},

Nous vous informons que votre bulletin scolaire pour la classe **{{ $classe->nom_classe }}** a été généré avec succès.

<x-mail::button :url="route('bulletins.show', $bulletin)">
Consulter Votre Bulletin
</x-mail::button>

**Informations du Bulletin:**
- **Apprenant:** {{ $apprenant->nom_apprenant }}
- **Classe:** {{ $classe->nom_classe }}
- **Filière:** {{ $classe->filiere->nom_filiere }}
- **Date de Génération:** {{ now()->format('d/m/Y à H:i') }}

Vous pouvez télécharger votre bulletin en PDF directement depuis votre espace personnel.

Si vous avez des questions concernant votre bulletin, veuillez contacter le secrétariat.

Cordialement,<br>
L'équipe de Gestion Bulletin CPET
</x-mail::message>
